<?php

namespace App\Http\Controllers;

use App\Models\BookingDetail;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingDetailController extends Controller
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
        return $this->success(BookingDetail::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required|integer',
            'user_id' => 'required|integer',
            'room_id' => 'required|integer',
            'seating_id' => 'required|integer',
            'start' => 'required|date',
            'finish' => 'required|date',
            'duration' => 'required|integer',
            'description' => 'required|min:3',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 422);
        }

        $bookingDetail = BookingDetail::create($request->all());
        return $this->success($bookingDetail, 'This booking has been created successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(BookingDetail $bookingDetail): \Illuminate\Http\JsonResponse
    {
        return $this->success($bookingDetail);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BookingDetail $bookingDetail): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'room_id' => 'required|integer',
            'seating_id' => 'required|integer',
            'start' => 'required|date',
            'finish' => 'required|date',
            'duration' => 'required|integer',
            'description' => 'required|min:3',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 422);
        }

        $bookingDetail->update($request->all());
        return $this->success($bookingDetail, 'This booking has been updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookingDetail $bookingDetail): \Illuminate\Http\JsonResponse
    {
        $bookingDetail->delete();
        return $this->success(null, 'This booking has been deleted successfully!!');
    }
}
