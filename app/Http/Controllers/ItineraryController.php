<?php

namespace App\Http\Controllers;

use App\Models\Itinerary;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ItineraryController extends Controller
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
        return $this->success(Itinerary::where('user_id', Auth::user()->id)->latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'vehicle_request_id' => 'required|integer',
            'item_id' => 'required|integer',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 500);
        }

        $itinerary = Itinerary::create($request->all());
        return $this->success($itinerary, 'Itinerary created successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Itinerary $itinerary): \Illuminate\Http\JsonResponse
    {
        return $this->success($itinerary);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Itinerary $itinerary): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'vehicle_request_id' => 'required|integer',
            'item_id' => 'required|integer',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 500);
        }

        $itinerary->update($request->all());
        return $this->success($itinerary, 'Itinerary updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Itinerary $itinerary): \Illuminate\Http\JsonResponse
    {
        $itinerary->delete();
        return $this->success(null, 'Itinerary deleted successfully!!');
    }
}
