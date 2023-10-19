<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReservationResource;
use App\Models\Consonance;
use App\Models\Reservation;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
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
        return $this->success(ReservationResource::collection(Reservation::where('user_id', Auth::user()->id)->latest()->get()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation): \Illuminate\Http\JsonResponse
    {
        return $this->success(new ReservationResource($reservation));
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'reservation_id' => 'required|integer',
            'itineraries' => 'required|array'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 500);
        }

        $reservation = Reservation::find($request->reservation_id);

        if (! $reservation) {
            return $this->error(null, 'Wrong Reservation ID provided', 422);
        }

        foreach ($request->itineraries as $itinerary) {
            $consonance = new Consonance;
            $consonance->user_id = $request->user_id;
            $consonance->description = $itinerary['description'];
            $consonance->path = $itinerary['itinerary'];
            $reservation->consonances()->save($consonance);
        }

        $reservation->update([
            'stage' => 'review'
        ]);

        return $this->success(new ReservationResource($reservation), 'Reservation updated successfully!!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'request_type' => 'required|string|max:255|in:staff,third-party',
            'type' => 'required|string|max:6|in:hotel,flight',
            'flight_type' => 'required|string|max:255|in:local,international',
            'name' => 'required|string|max:255',
            'mobile' => 'required|string',
            'take_off' => 'required|string',
            'destination' => 'required|string',
            'begin' => 'required|date',
            'elapse' => 'required|date',
            'duration' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 500);
        }

        $reservation->update($request->all());
        return $this->success(new ReservationResource($reservation), 'Reservation updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation): \Illuminate\Http\JsonResponse
    {
        $reservation->delete();
        return $this->success(null, 'Reservation deleted successfully!!');
    }
}
