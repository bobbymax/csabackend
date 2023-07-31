<?php

namespace App\Http\Controllers;

use App\Models\Quota;
use App\Models\QuotaItem;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuotaController extends Controller
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
        return $this->success(Quota::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'group_id' => 'required|integer',
            'month' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'items' => 'required|array'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $quota = Quota::create($request->except('items'));

        foreach($request->items as $item) {
            QuotaItem::create([
                'quota_id' => $quota->id,
                'item_id' => $item['item_id'],
                'quantity' => $item['item_quantity']
            ]);
        }

        return $this->success($quota, 'Quota created successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Quota $quota): \Illuminate\Http\JsonResponse
    {
        return $this->success($quota);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quota $quota): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'group_id' => 'required|integer',
            'month' => 'required|string|max:255',
            'quantity' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $quota->update($request->except('items'));
        return $this->success($quota, 'Quota updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quota $quota): \Illuminate\Http\JsonResponse
    {
        $quota->delete();
        return $this->success($quota, 'Quota deleted successfully!!');
    }
}
