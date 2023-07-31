<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LocationController extends Controller
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
        return $this->success(Location::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'hasFloors' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $location = Location::create([
            'name' => $request->name,
            'label' => Str::slug($request->name),
            'hasFloors' => $request->hasFloors
        ]);

        return $this->success($location, 'Location created successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location): \Illuminate\Http\JsonResponse
    {
        return $this->success($location);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'hasFloors' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $location->update([
            'name' => $request->name,
            'label' => Str::slug($request->name),
            'hasFloors' => $request->hasFloors
        ]);

        return $this->success($location, 'Location updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location): \Illuminate\Http\JsonResponse
    {
        $location->delete();
        return $this->success(null, 'Location deleted successfully!!');
    }
}
