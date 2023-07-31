<?php

namespace App\Http\Controllers;

use App\Models\Seating;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SeatingController extends Controller
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
        return $this->success(Seating::latest()->get());
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

        $seating = Seating::create($request->all());
        return $this->success($seating, 'Seating created successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Seating $seating): \Illuminate\Http\JsonResponse
    {
        return $this->success($seating);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seating $seating): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $seating->update($request->all());
        return $this->success($seating, 'Seating updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seating $seating): \Illuminate\Http\JsonResponse
    {
        $seating->delete();
        return $this->success(null, 'Seating deleted successfully!!');
    }
}
