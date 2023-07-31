<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BrandController extends Controller
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
        return $this->success(Brand::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors', 500);
        }

        $brand = Brand::create([...$request->all(), 'label' => Str::slug($request->name)]);
        return $this->success($brand, 'Brand created successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand): \Illuminate\Http\JsonResponse
    {
        return $this->success($brand);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors', 500);
        }

        $brand->update([...$request->all(), 'label' => Str::slug($request->name)]);
        return $this->success($brand, 'Brand updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand): \Illuminate\Http\JsonResponse
    {
        $brand->delete();
        return $this->success(null, 'Brand deleted successfully!!');
    }
}
