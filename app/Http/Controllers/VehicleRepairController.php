<?php

namespace App\Http\Controllers;

use App\Models\VehicleRepair;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehicleRepairController extends Controller
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
        return $this->success(VehicleRepair::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'complaint_id' => 'required|integer',
            'repair_id' => 'required|integer',
            'cost' => 'required',
            'description' => 'required|min:3',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $vehicleRepair = VehicleRepair::create($request->all());
        return $this->success($vehicleRepair, 'Vehicle Repair has been added successful', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(VehicleRepair $vehicleRepair): \Illuminate\Http\JsonResponse
    {
        return $this->success($vehicleRepair);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VehicleRepair $vehicleRepair): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'complaint_id' => 'required|integer',
            'repair_id' => 'required|integer',
            'cost' => 'required',
            'description' => 'required|min:3',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $vehicleRepair->update($request->all());
        return $this->success($vehicleRepair, 'Vehicle Repair has been updated successful');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VehicleRepair $vehicleRepair): \Illuminate\Http\JsonResponse
    {
        $vehicleRepair->delete();
        return $this->success(null, 'Vehicle Repair has been deleted successful');
    }
}
