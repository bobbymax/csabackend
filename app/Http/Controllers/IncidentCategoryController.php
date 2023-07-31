<?php

namespace App\Http\Controllers;

use App\Models\IncidentCategory;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class IncidentCategoryController extends Controller
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
        return $this->success(IncidentCategory::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'department_id' => 'required|integer',
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $incidentCategory = IncidentCategory::create([...$request->all(), 'label' => Str::slug($request->name)]);
        return $this->success($incidentCategory, 'Category created successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(IncidentCategory $incidentCategory): \Illuminate\Http\JsonResponse
    {
        return $this->success($incidentCategory);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IncidentCategory $incidentCategory): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'department_id' => 'required|integer',
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $incidentCategory->update([...$request->all(), 'label' => Str::slug($request->name)]);
        return $this->success($incidentCategory, 'Category updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IncidentCategory $incidentCategory): \Illuminate\Http\JsonResponse
    {
        $incidentCategory->delete();
        return $this->success(null, 'Category deleted successfully!!');
    }
}
