<?php

namespace App\Http\Controllers;

use App\Models\RepairCategory;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RepairCategoryController extends Controller
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
        return $this->success(RepairCategory::latest()->get());
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

        $repairCategory = RepairCategory::create($request->all());
        return $this->success($repairCategory, 'Repair Category created successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(RepairCategory $repairCategory): \Illuminate\Http\JsonResponse
    {
        return $this->success($repairCategory);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RepairCategory $repairCategory): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $repairCategory->update($request->all());
        return $this->success($repairCategory, 'Repair Category updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RepairCategory $repairCategory): \Illuminate\Http\JsonResponse
    {
        $repairCategory->delete();
        return $this->success(null, 'Repair Category deleted successfully!!');
    }
}
