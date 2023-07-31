<?php

namespace App\Http\Controllers;


use App\Models\StockType;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StockTypeController extends Controller
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
        return $this->success(StockType::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'stock_category_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 500);
        }

        $stockType = StockType::create($request->all());
        return $this->success($stockType, 'Stock Type created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(StockType $stockType): \Illuminate\Http\JsonResponse
    {
        return $this->success($stockType);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StockType $stockType): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'stock_category_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 500);
        }

        $stockType->update($request->all());
        return $this->success($stockType, 'Stock Type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockType $stockType): \Illuminate\Http\JsonResponse
    {
        $stockType->delete();
        return $this->success(null, 'Stock Type deleted successfully!');
    }
}
