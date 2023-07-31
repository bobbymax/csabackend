<?php

namespace App\Http\Controllers;

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
        return $this->success($requisitionItem);
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
        return $this->success($requisitionItem, 'Requisition Item has been updated successfully!!');
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
