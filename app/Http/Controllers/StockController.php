<?php

namespace App\Http\Controllers;

use App\Http\Resources\StockResource;
use App\Models\Restock;
use App\Models\Stock;
use App\Models\Tag;
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
        return $this->success(StockResource::collection(Stock::latest()->get()));
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
            'tags' => 'required|array'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 500);
        }

        $stock = Stock::create([...$request->except('number'), 'label' => Str::slug($request->name)]);

        if ($request->has('tags')) {
            foreach ($request->tags as $value) {
                $tag = Tag::find($value);
                if ($tag) {
                    $stock->tags()->save($tag);
                }
            }
        }

//        if ($stock && $stock->restockable) {
//            Restock::create([
//                'stock_id' => $stock->id,
//                'user_id' => Auth::user()->id,
//                'quantity' => $request->quantity,
//            ]);
//        }

        return $this->success(new StockResource($stock), 'Stock has been created successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock): \Illuminate\Http\JsonResponse
    {
        return $this->success(new StockResource($stock));
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

        $stock->update([...$request->except('code', 'number'), 'label' => Str::slug($request->name)]);
        return $this->success(new StockResource($stock), 'Stock has been updated successfully!!');
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
