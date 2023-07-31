<?php

namespace App\Http\Controllers;

use App\Models\ItemFeature;
use App\Traits\HttpResponses;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemFeatureController extends Controller
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
        return $this->success(ItemFeature::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'item_id' => 'required|integer',
            'color' => 'required',
            'tank_capacity' => 'required|integer',
            'insurance_due_date' => 'required|date',
            'insurance_status' => 'required|string|max:255|in:comprehensive,third-party-plus,third-party',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following:', 500);
        }

        $feature = ItemFeature::create([...$request->all(), 'insurance_due_date' => Carbon::parse($request->insurance_due_date)]);
        return $this->success($feature, 'Item Feature created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ItemFeature $itemFeature): \Illuminate\Http\JsonResponse
    {
        return $this->success($itemFeature);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ItemFeature $itemFeature): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'item_id' => 'required|integer',
            'color' => 'required',
            'tank_capacity' => 'required|integer',
            'insurance_due_date' => 'required|date',
            'insurance_status' => 'required|string|max:255|in:comprehensive,third-party-plus,third-party',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following:', 500);
        }

        $itemFeature->update([...$request->all(), 'insurance_due_date' => Carbon::parse($request->insurance_due_date)]);
        return $this->success($itemFeature, 'Item Feature updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemFeature $itemFeature): \Illuminate\Http\JsonResponse
    {
        $itemFeature->delete();
        return $this->success(null, 'Item Feature deleted successfully');
    }
}
