<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Traits\HttpResponses;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return $this->success(BookingResource::collection(Booking::with('details')->where('user_id', Auth::user()->id)->latest()->get()));
    }

    public function getPendingBookingRequests(): \Illuminate\Http\JsonResponse
    {
        return $this->success(BookingResource::collection(Booking::with('details')->latest()->get()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'code' => 'required|string|max:255|unique:bookings',
            'budget_code' => 'string|max:15',
            'start' => 'required|date',
            'finish' => 'required|date',
            'description' => 'required|min:3',
            'title' => 'required|string|max:255',
            'details' => 'required|array'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 422);
        }

        $booking = Booking::create([...$request->except('details', 'start', 'finish', 'startTime', 'endTime', 'id'), 'start' => Carbon::parse($request->start), 'finish' => Carbon::parse($request->finish)]);

        if ($booking) {
            foreach ($request->details as $detail) {
                BookingDetail::create([
                    'booking_id' => $booking->id,
                    'user_id' => $detail['contact_id'],
                    'room_id' => $detail['room_id'],
                    'seating_id' => $detail['seating_id'],
                    'start' => Carbon::parse($detail['start']),
                    'finish' => Carbon::parse($detail['finish']),
                    'pa_system' => $detail['pa_system'],
                    'audio_visual_system' => $detail['audio_visual_system'],
                    'internet' => $detail['internet'],
                    'tea_snacks' => $detail['tea_snacks'],
                    'breakfast' => $detail['breakfast'],
                    'lunch' => $detail['lunch'],
                    'description' => $detail['description'],
                ]);
            }
        }

        return $this->success(new BookingResource($booking), 'Booking request has been created successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking): \Illuminate\Http\JsonResponse
    {
        return $this->success(new BookingResource($booking));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|max:255|in:approved,denied',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 422);
        }

        $booking->update($request->all());

        if ($request->status === "approved") {
            $booking->task->status = "completed";
            $booking->task->save();
        }

        return $this->success(new BookingResource($booking), 'Booking request has been updated successfully!!');
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
