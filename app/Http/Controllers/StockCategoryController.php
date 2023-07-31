<?php

namespace App\Http\Controllers;

use App\Models\StockCategory;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StockCategoryController extends Controller
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
        return $this->success(StockCategory::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'inventory_category_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 500);
        }

        $stockCategory = StockCategory::create($request->all());
        return $this->success($stockCategory, 'Stock Category created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(StockCategory $stockCategory): \Illuminate\Http\JsonResponse
    {
        return $this->success($stockCategory);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StockCategory $stockCategory): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'inventory_category_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 500);
        }

        $stockCategory->update($request->all());
        return $this->success($stockCategory, 'Stock Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockCategory $stockCategory): \Illuminate\Http\JsonResponse
    {
        $stockCategory->delete();
        return $this->success(null, 'Stock Category deleted successfully!');
    }
}
