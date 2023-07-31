<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\InventoryCategory;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InventoryCategoryController extends Controller
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
        return $this->success(Auth::user()->department->inventoryCategories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'department_id' => 'required|integer',
            'name' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 500);
        }

        $department = Department::find($request->department_id);
        $inventoryCategory = InventoryCategory::create($request->except('department_id'));
        $department?->inventoryCategories()->save($inventoryCategory);

        return $this->success($inventoryCategory, 'This category has been created successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(InventoryCategory $inventoryCategory): \Illuminate\Http\JsonResponse
    {
        return $this->success($inventoryCategory);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InventoryCategory $inventoryCategory): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 500);
        }

        $inventoryCategory->update($request->all());

        return $this->success($inventoryCategory, 'This category has been updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InventoryCategory $inventoryCategory): \Illuminate\Http\JsonResponse
    {
        $inventoryCategory->departments()->detach();
        $inventoryCategory->delete();
        return $this->success(null, 'Category deleted successfully!!');
    }
}
