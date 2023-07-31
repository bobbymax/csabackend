<?php

namespace App\Http\Controllers;

use App\Models\Item;
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
        return $this->success(Item::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
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

        $item = Item::create([...$request->all(), 'date_of_purchase' => Carbon::parse($request->date_of_purchase), 'delivery_date' => Carbon::parse($request->delivery_date)]);
        return $this->success($item, 'Item has been added successfully!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item): \Illuminate\Http\JsonResponse
    {
        return $this->success($item);
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

        $item->update([...$request->except('barcode'), 'date_of_purchase' => Carbon::parse($request->date_of_purchase), 'delivery_date' => Carbon::parse($request->delivery_date)]);
        return $this->success($item, 'Item has been updated successfully!!');
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
