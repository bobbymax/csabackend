<?php

namespace App\Http\Controllers;

use App\Models\QuotaItem;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuotaItemController extends Controller
{
    use HttpResponses;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display the specified resource.
     */
    public function show(QuotaItem $quotaItem): \Illuminate\Http\JsonResponse
    {
        return $this->success($quotaItem);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuotaItem $quotaItem): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'quota_id' => 'required|integer',
            'item_id' => 'required|integer',
            'quantity' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $quotaItem->update($request->all());
        return $this->success($quotaItem, 'Quota Item updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuotaItem $quotaItem): \Illuminate\Http\JsonResponse
    {
        $quotaItem->delete();
        return $this->success(null, 'Quota Item deleted successfully!!');
    }
}
