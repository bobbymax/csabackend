<?php

namespace App\Http\Controllers;

use App\Models\HallCategory;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HallCategoryController extends Controller
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
        return $this->success(HallCategory::latest()->get());
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

        $hallCategory = HallCategory::create($request->all());
        return $this->success($hallCategory, 'Hall Category created successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(HallCategory $hallCategory): \Illuminate\Http\JsonResponse
    {
        return $this->success($hallCategory);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HallCategory $hallCategory): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $hallCategory->update($request->all());
        return $this->success($hallCategory, 'Hall Category updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HallCategory $hallCategory): \Illuminate\Http\JsonResponse
    {
        $hallCategory->delete();
        return $this->success(null, 'Hall Category deleted successfully!!');
    }
}
