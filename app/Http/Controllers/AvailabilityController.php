<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AvailabilityController extends Controller
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
        return $this->success(Availability::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $availability = Availability::create([
            'name' => $request->name,
            'label' => Str::slug($request->name)
        ]);

        return $this->success($availability, 'Status created successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Availability $availability): \Illuminate\Http\JsonResponse
    {
        return $this->success($availability);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Availability $availability): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $availability->update([
            'name' => $request->name,
            'label' => Str::slug($request->name)
        ]);

        return $this->success($availability, 'Status updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Availability $availability): \Illuminate\Http\JsonResponse
    {
        $availability->delete();
        return $this->success(null, 'Status deleted successfully!!');
    }
}
