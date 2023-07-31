<?php

namespace App\Http\Controllers;

use App\Models\FurnitureRequestItem;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FurnitureRequestItemController extends Controller
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
        return $this->success(FurnitureRequestItem::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'furniture_request_id' => 'required|integer',
            'item_id' => 'required|integer',
            'quantity' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 500);
        }

        $furnitureRequestItem = FurnitureRequestItem::create($request->all());
        return $this->success($furnitureRequestItem, 'Furniture Request Item has been added successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(FurnitureRequestItem $furnitureRequestItem): \Illuminate\Http\JsonResponse
    {
        return $this->success($furnitureRequestItem);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FurnitureRequestItem $furnitureRequestItem): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'furniture_request_id' => 'required|integer',
            'item_id' => 'required|integer',
            'quantity' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 500);
        }

        $furnitureRequestItem->update($request->all());
        return $this->success($furnitureRequestItem, 'Furniture Request Item has been updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FurnitureRequestItem $furnitureRequestItem): \Illuminate\Http\JsonResponse
    {
        $furnitureRequestItem->delete();
        return $this->success(null, 'Furniture Request Item has been deleted successfully!!');
    }
}
