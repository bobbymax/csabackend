<?php

namespace App\Http\Controllers;

use App\Http\Resources\RequisitionItemResource;
use App\Models\RequisitionItem;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RequisitionItemController extends Controller
{
    use HttpResponses;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display the specified resource.
     */
    public function show(RequisitionItem $requisitionItem): \Illuminate\Http\JsonResponse
    {
        return $this->success(new RequisitionItemResource($requisitionItem));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RequisitionItem $requisitionItem): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'requisition_id' => 'required|integer',
            'item_id' => 'required|integer',
            'quantity_expected' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $requisitionItem->update($request->all());
        return $this->success(new RequisitionItemResource($requisitionItem), 'Requisition Item has been updated successfully!!');
    }

    public function updateStatus(Request $request, RequisitionItem $requisitionItem): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:unavailable',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $requisitionItem->update($request->only('status'));

        return $this->success(new RequisitionItemResource($requisitionItem), 'Requisition Item has been marked as unavailable successfully!!');
    }

    public function treatReq(Request $request, RequisitionItem $requisitionItem): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'quantity_received' => 'required|integer',
            'status' => 'required|string|in:issued',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $requisitionItem->update($request->all());

        $requisitionItem->item->decrement('quantity', $request->quantity_received);
        return $this->success(new RequisitionItemResource($requisitionItem), 'Requisition Item has been updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RequisitionItem $requisitionItem): \Illuminate\Http\JsonResponse
    {
        $requisitionItem->delete();
        return $this->success(null, 'Requisition Item has been deleted successfully!!');
    }
}
