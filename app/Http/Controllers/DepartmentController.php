<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
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
        return $this->success(Department::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'department_type_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:8|unique:departments',
            'parentId' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors', 500);
        }

        $department = Department::create($request->all());
        return $this->success($department, 'Department created successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department): \Illuminate\Http\JsonResponse
    {
        return $this->success($department);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'department_type_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:8',
            'parentId' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors', 500);
        }

        $department->update($request->all());
        return $this->success($department, 'Department updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department): \Illuminate\Http\JsonResponse
    {
        $department->delete();
        return $this->success(null, 'Department updated successfully!!');
    }
}
