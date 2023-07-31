<?php

namespace App\Http\Controllers;

use App\Models\Requisition;
use App\Models\RequisitionItem;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RequisitionController extends Controller
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
        return $this->success(Requisition::where('user_id', Auth::user()->id)->latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'location_id' => 'required|integer',
            'code' => 'required|string|max:10|unique:requisitions',
            'type' => 'required|string|max:30|in:quota,request',
            'request_type' => 'required|string|max:30|in:staff,third-party',
            'items' => 'required|array'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $requisition = Requisition::create($request->except('items'));

        foreach ($request->items as $item) {
            RequisitionItem::create([
                'requisition_id' => $requisition->id,
                'item_id' => $item['item_id'],
                'quantity_expected' => $item['quantity_expected']
            ]);
        }

        return $this->success($requisition, 'Requisition request created successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Requisition $requisition): \Illuminate\Http\JsonResponse
    {
        return $this->success($requisition);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Requisition $requisition): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'location_id' => 'required|integer',
            'code' => 'required|string|max:10|unique:requisitions',
            'type' => 'required|string|max:30|in:quota,request',
            'request_type' => 'required|string|max:30|in:staff,third-party',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $requisition->update($request->except('items'));
        return $this->success($requisition, 'Requisition request updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Requisition $requisition): \Illuminate\Http\JsonResponse
    {
        $requisition->delete();
        return $this->success(null, 'Requisition request deleted successfully!!');
    }
}
