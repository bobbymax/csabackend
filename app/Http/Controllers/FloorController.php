<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FloorController extends Controller
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
        return $this->success(Floor::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'number' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $floor = Floor::create($request->all());

        return $this->success($floor, 'Floor created successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Floor $floor): \Illuminate\Http\JsonResponse
    {
        return $this->success($floor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Floor $floor): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'number' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $floor->update($request->all());

        return $this->success($floor, 'Floor updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Floor $floor): \Illuminate\Http\JsonResponse
    {
        $floor->delete();
        return $this->success(null, 'Floor deleted successfully!!');
    }
}
