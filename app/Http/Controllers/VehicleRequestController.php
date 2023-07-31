<?php

namespace App\Http\Controllers;

use App\Models\VehicleRequest;
use App\Traits\HttpResponses;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehicleRequestController extends Controller
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
       return $this->success(VehicleRequest::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'stock_type_id' => 'required|integer',
            'location_id' => 'required|integer',
            'code' => 'required|string|max:10|unique:vehicle_requests',
            'required_date' => 'required|date',
            'return_date' => 'required|date',
            'duration' => 'required|integer',
            'destination' => 'required|string',
            'nature_of_trip' => 'required|string|max:255|in:personal,official',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 500);
        }

        $vehicleRequest = VehicleRequest::create([...$request->except('required_date', 'return_date'), 'required_date' => Carbon::parse($request->required_date), 'return_date' => Carbon::parse($request->return_date)]);
        return $this->success($vehicleRequest, 'Request has been logged successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(VehicleRequest $vehicleRequest): \Illuminate\Http\JsonResponse
    {
        return $this->success($vehicleRequest);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VehicleRequest $vehicleRequest): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'stock_type_id' => 'required|integer',
            'location_id' => 'required|integer',
            'required_date' => 'required|date',
            'return_date' => 'required|date',
            'duration' => 'required|integer',
            'destination' => 'required|string',
            'nature_of_trip' => 'required|string|max:255|in:personal,official',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 500);
        }

        $vehicleRequest->update([...$request->except('required_date', 'return_date', 'code'), 'required_date' => Carbon::parse($request->required_date), 'return_date' => Carbon::parse($request->return_date)]);
        return $this->success($vehicleRequest, 'Request has been updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VehicleRequest $vehicleRequest): \Illuminate\Http\JsonResponse
    {
        $vehicleRequest->delete();
        return $this->success(null, 'Request has been deleted successfully!!');
    }
}
