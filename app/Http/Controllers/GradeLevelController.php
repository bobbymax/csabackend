<?php

namespace App\Http\Controllers;

use App\Models\GradeLevel;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GradeLevelController extends Controller
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
        return $this->success(GradeLevel::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'key' => 'required|string|max:5|unique:grade_levels'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $gradeLevel = GradeLevel::create([
            'name' => $request->name,
            'key' => $request->key
        ]);

        return $this->success($gradeLevel, 'Grade Level created successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(GradeLevel $gradeLevel): \Illuminate\Http\JsonResponse
    {
        return $this->success($gradeLevel);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GradeLevel $gradeLevel): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'key' => 'required|string|max:5'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $gradeLevel->update([
            'name' => $request->name,
            'key' => $request->key
        ]);

        return $this->success($gradeLevel, 'Grade Level updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GradeLevel $gradeLevel): \Illuminate\Http\JsonResponse
    {
        $gradeLevel->delete();
        return $this->success(null, 'Grade Level deleted successfully!!');
    }
}
