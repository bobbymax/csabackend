<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemResource;
use App\Models\Item;
use App\Models\ItemFeature;
use App\Traits\HttpResponses;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
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
        return $this->success(ItemResource::collection(Item::latest()->get()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'stock_id' => 'required|integer',
            'location_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following:', 500);
        }

        $item = Item::create([...$request->except('hasFeature', 'id'), 'date_of_purchase' => Carbon::parse($request->date_of_purchase), 'delivery_date' => Carbon::parse($request->delivery_date)]);

        if ($request->hasFeature) {
            ItemFeature::create([
                'item_id' => $item?->id,
                'color' => $request->color,
                'tank_capacity' => $request->tank_capacity,
                'insurance_due_date' => Carbon::parse($request->insurance_due_date),
                'insurance_status' => $request->insurance_status
            ]);
        }

        return $this->success(new ItemResource($item), 'Item has been added successfully!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item): \Illuminate\Http\JsonResponse
    {
        return $this->success(new ItemResource($item));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'stock_id' => 'required|integer',
            'company_id' => 'required|integer',
            'location_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'date_of_purchase' => 'required|date',
            'delivery_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following:', 500);
        }

        $item->update([...$request->except('barcode', 'hasFeature', 'id'), 'date_of_purchase' => Carbon::parse($request->date_of_purchase), 'delivery_date' => Carbon::parse($request->delivery_date)]);
        return $this->success(new ItemResource($item), 'Item has been updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item): \Illuminate\Http\JsonResponse
    {
        $item->delete();
        return $this->success(null, 'Item has been deleted successfully!!');
    }
}
