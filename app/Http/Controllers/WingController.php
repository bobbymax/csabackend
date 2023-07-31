<?php

namespace App\Http\Controllers;

use App\Models\Wing;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WingController extends Controller
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
        return $this->success(Wing::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $wing = Wing::create($request->all());
        return $this->success($wing, 'Hall Wing created successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Wing $wing): \Illuminate\Http\JsonResponse
    {
        return $this->success($wing);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wing $wing): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $wing->update($request->all());
        return $this->success($wing, 'Hall Wing updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wing $wing): \Illuminate\Http\JsonResponse
    {
        $wing->delete();
        return $this->success(null, 'Hall Wing deleted successfully!!');
    }
}
