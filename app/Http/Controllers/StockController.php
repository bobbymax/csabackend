<?php

namespace App\Http\Controllers;

use App\Models\Restock;
use App\Models\Stock;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class StockController extends Controller
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
        return $this->success(Stock::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'stock_type_id' => 'required|integer',
            'department_id' => 'required|integer',
            'quantity' => 'required|integer',
            'code' => 'required|string|max:8|unique:stocks',
            'name' => 'required|string|max:255',
            'measure' => 'required|string|max:255|in:single,packs,boxes,cartons',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 500);
        }

        $stock = Stock::create([...$request->all(), 'label' => Str::slug($request->name)]);

        if ($stock) {
            Restock::create([
                'stock_id' => $stock->id,
                'user_id' => Auth::user()->id,
                'quantity' => $request->quantity,
            ]);
        }
        return $this->success($stock, 'Stock has been created successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock): \Illuminate\Http\JsonResponse
    {
        return $this->success($stock);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'stock_type_id' => 'required|integer',
            'department_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'measure' => 'required|string|max:255|in:single,packs,boxes,cartons',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 500);
        }

        $stock->update([...$request->except('code'), 'label' => Str::slug($request->name)]);
        return $this->success($stock, 'Stock has been updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock): \Illuminate\Http\JsonResponse
    {
        $stock->delete();
        return $this->success(null, 'Stock has been deleted successfully!!');
    }
}
