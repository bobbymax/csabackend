<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingDetail;
use App\Traits\HttpResponses;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
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
        return $this->success(Booking::with('details')->latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'code' => 'required|string|max:255|unique:bookings',
            'budget_code' => 'required|string|max:15',
            'start' => 'required|date',
            'finish' => 'required|date',
            'duration' => 'required|integer',
            'description' => 'required|min:3',
            'details' => 'required|array'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 422);
        }

        $booking = Booking::create([...$request->except('details', 'start', 'finish'), 'start' => Carbon::parse($request->start), 'finish' => Carbon::parse($request->finish)]);

        if ($booking) {
            foreach ($request->details as $detail) {
                BookingDetail::create([...$detail, 'booking_id' => $booking->id]);
            }
        }

        return $this->success($booking, 'Booking request has been created successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking): \Illuminate\Http\JsonResponse
    {
        return $this->success($booking);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'budget_code' => 'required|string|max:15',
            'start' => 'required|date',
            'finish' => 'required|date',
            'duration' => 'required|integer',
            'description' => 'required|min:3',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 422);
        }

        $booking->update([...$request->except('details', 'code', 'start', 'finish'), 'start' => Carbon::parse($request->start), 'finish' => Carbon::parse($request->finish)]);
        return $this->success($booking, 'Booking request has been updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking): \Illuminate\Http\JsonResponse
    {
        $booking->delete();
        return $this->success(null, 'This booking request has been deleted successfully!!');
    }
}
