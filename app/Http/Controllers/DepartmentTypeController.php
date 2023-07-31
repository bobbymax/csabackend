<?php

namespace App\Http\Controllers;

use App\Models\DepartmentType;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DepartmentTypeController extends Controller
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
        return $this->success(DepartmentType::latest()->get());
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

        $departmentType = DepartmentType::create([
            'name' => $request->name,
            'label' => Str::slug($request->name)
        ]);

        return $this->success($departmentType, 'Department Type created successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(DepartmentType $departmentType): \Illuminate\Http\JsonResponse
    {
        return $this->success($departmentType);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DepartmentType $departmentType): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $departmentType->update([
            'name' => $request->name,
            'label' => Str::slug($request->name)
        ]);

        return $this->success($departmentType, 'Department Type updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DepartmentType $departmentType): \Illuminate\Http\JsonResponse
    {
        $departmentType->delete();
        return $this->success(null, 'Department Type deleted successfully!!');
    }
}
