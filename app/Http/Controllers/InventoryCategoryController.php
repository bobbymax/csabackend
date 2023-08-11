<?php

namespace App\Http\Controllers;

use App\Http\Resources\InventoryCategoryResource;
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
        return $this->success(InventoryCategoryResource::collection(Auth::user()->department->inventoryCategories));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'departments' => 'required|array'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 500);
        }

        $inventoryCategory = InventoryCategory::create($request->except('departments'));

        foreach ($request->departments as $value) {
            $department = Department::find($value);
            $inventoryCategory?->departments()->save($department);
        }

        return $this->success(new InventoryCategoryResource($inventoryCategory), 'This category has been created successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(InventoryCategory $inventoryCategory): \Illuminate\Http\JsonResponse
    {
        return $this->success(new InventoryCategoryResource($inventoryCategory));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InventoryCategory $inventoryCategory): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'departments' => 'required|array'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 500);
        }

        $inventoryCategory->update($request->only('name'));

        if ($request->has('departments')) {
            foreach ($inventoryCategory->departments->pluck('id')->toArray() as $value) {
                $department = Department::find($value);

                if (!in_array($department?->id, $request->departments)) {
                    $inventoryCategory->departments()->detach($department);
                }
            }

            foreach ($request->departments as $value) {
                $dept = Department::find($value);

                if (!in_array($dept?->id, $inventoryCategory->departments->pluck('id')->toArray())) {
                    $inventoryCategory->departments()->save($dept);
                }
            }
        }

        return $this->success(new InventoryCategoryResource($inventoryCategory), 'This category has been updated successfully!!');
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
