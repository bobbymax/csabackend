<?php

namespace App\Http\Controllers;

use App\Http\Resources\FurnitureRequestResource;
use App\Models\FurnitureRequest;
use App\Models\FurnitureRequestItem;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FurnitureRequestController extends Controller
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
        return $this->success(FurnitureRequestResource::collection(FurnitureRequest::where('user_id', Auth::user()->id)->latest()->get()));
    }

    public function getFurnitureRequests(): \Illuminate\Http\JsonResponse
    {
        return $this->success(FurnitureRequestResource::collection(FurnitureRequest::latest()->get()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'location_id' => 'required|integer',
            'code' => 'required|string|max:15|unique:furniture_requests',
            'description' => 'required|min:3',
            'type' => 'required|string|max:255|in:new,repair,replacement,move',
            'furniture' => 'required|array'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 500);
        }

        $furnitureRequest = FurnitureRequest::create($request->except('furniture'));
        foreach ($request->furniture as $furniture) {
            FurnitureRequestItem::create([
                'furniture_request_id' => $furnitureRequest->id,
                'item_id' => $furniture['item_id'],
                'quantity' => $furniture['quantity']
            ]);
        }

        return $this->success(new FurnitureRequestResource($furnitureRequest), 'Furniture Request has been logged successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(FurnitureRequest $furnitureRequest): \Illuminate\Http\JsonResponse
    {
        return $this->success(new FurnitureRequestResource($furnitureRequest));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FurnitureRequest $furnitureRequest): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'location_id' => 'required|integer',
            'description' => 'required|min:3',
            'type' => 'required|string|max:255|in:new,repair,replacement,move',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 500);
        }

        $furnitureRequest->update($request->except('furnitures'));


        if ($request->status === "resolved") {
            $furnitureRequest->task->status = "completed";
            $furnitureRequest->task->save();
        }

        return $this->success(new FurnitureRequestResource($furnitureRequest), 'Furniture Request has been updated successfully!!');
    }

    public function completeRequest(Request $request, FurnitureRequest $furnitureRequest): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|max:255|in:approved,denied',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 500);
        }

        $furnitureRequest->update($request->all());
        return $this->success(new FurnitureRequestResource($furnitureRequest), 'Furniture Request has been completed successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FurnitureRequest $furnitureRequest): \Illuminate\Http\JsonResponse
    {
        $furnitureRequest->delete();
        return $this->success(null, 'Furniture Request has been deleted successfully!!');
    }
}
