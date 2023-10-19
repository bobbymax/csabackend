<?php

namespace App\Http\Controllers;

use App\Http\Resources\LogisticsRequestResource;
use App\Models\LogisticsRequest;
use App\Models\Reservation;
use App\Traits\HttpResponses;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LogisticsRequestController extends Controller
{
    use HttpResponses;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return $this->success(LogisticsRequestResource::collection(LogisticsRequest::where('user_id', Auth::user()->id)->latest()->get()));
    }

    public function getPendingReservations(): \Illuminate\Http\JsonResponse
    {
        return $this->success(LogisticsRequestResource::collection(LogisticsRequest::latest()->get()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'code' => 'required|string|max:255|unique:logistics_requests',
            'budget_code' => 'required|string|max:10',
            'description' => 'required|min:3',
            'reservations' => 'required|array'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 500);
        }

        $logisticsRequest = LogisticsRequest::create($request->except('reservations'));

        foreach($request->reservations as $reservation) {
            Reservation::create([
                'user_id' => $reservation['beneficiary_id'],
                'logistics_request_id' => $logisticsRequest->id,
                'request_type' => $reservation['request_type'],
                'type' => $reservation['type'],
                'flight_type' => $reservation['flight_type'] ?? "international",
                'name' => $reservation['name'],
                'take_off' => $reservation['take_off'],
                'destination' => $reservation['destination'],
                'begin' => Carbon::parse($reservation['begin']),
                'elapse' => Carbon::parse($reservation['elapse']),
                'duration' => $reservation['duration'],
                'approval_memo' => $reservation['approval_memo'],
                'data_page' => $reservation['data_page'],
                'visa' => $reservation['visa'],
                'instructions' => $reservation['instructions']
            ]);
        }

        return $this->success(new LogisticsRequestResource($logisticsRequest), 'Logistics Request has been created successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(LogisticsRequest $logisticsRequest): \Illuminate\Http\JsonResponse
    {
        return $this->success(new LogisticsRequestResource($logisticsRequest));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LogisticsRequest $logisticsRequest): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'code' => 'required|string|max:10|unique:vehicle_requests',
            'budget_code' => 'required|string|max:10',
            'description' => 'required|min:3',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 500);
        }

        $logisticsRequest->update($request->except('reservations'));
        return $this->success(new LogisticsRequestResource($logisticsRequest), 'Logistics Request has been updated successfully!!');
    }

    public function updateLogisticsRequestStatus(Request $request, LogisticsRequest $logisticsRequest): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|max:255|in:registered,approved,denied,processing,confirmed,canceled',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 500);
        }
        $logisticsRequest->update($request->all());

        if ($request->status === "confirmed") {
            $logisticsRequest->task->status = "completed";
            $logisticsRequest->task->save();
        }

        return $this->success(new LogisticsRequestResource($logisticsRequest), 'Logistics Request has been updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LogisticsRequest $logisticsRequest): \Illuminate\Http\JsonResponse
    {
        $logisticsRequest->delete();
        return $this->success(null, 'Logistics Request has been deleted successfully!!');
    }
}
