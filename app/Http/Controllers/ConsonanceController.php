<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReservationResource;
use App\Models\Consonance;
use App\Models\Reservation;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConsonanceController extends Controller
{
    use HttpResponses;
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Consonance $consonance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Consonance $consonance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Consonance $consonance): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'reservation_id' => 'required|integer',
            'itineraries' => 'array',
            'status' => 'required|string|max:255|in:accepted,declined'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors', 500);
        }

        $reservation = Reservation::find($request->reservation_id);

        if (! $reservation) {
            return $this->error(null, 'This reservation ID is wrong', 422);
        }

        $consonance->update($request->only('status'));

        foreach($request->itineraries as $obj) {
            $cons = Consonance::find($obj['id']);

            if ($cons) {
                $cons->update([
                    'status' => 'declined'
                ]);
            }
        }

        $reservation->update([
            'stage' => 'selected'
        ]);

        return $this->success(new ReservationResource($reservation), 'This booking has been confirmed');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consonance $consonance)
    {
        //
    }
}
