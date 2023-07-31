<?php

namespace App\Http\Controllers;

use App\Models\Repair;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RepairController extends Controller
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
        return $this->success(Repair::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'item' => 'required|string|max:255',
            'repair_category_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $repair = Repair::create($request->all());
        return $this->success($repair, 'Repair created successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Repair $repair): \Illuminate\Http\JsonResponse
    {
        return $this->success($repair);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Repair $repair): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'item' => 'required|string|max:255',
            'repair_category_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $repair->update($request->all());
        return $this->success($repair, 'Repair updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Repair $repair): \Illuminate\Http\JsonResponse
    {
        $repair->delete();
        return $this->success(null, 'Repair deleted successfully!!');
    }
}
