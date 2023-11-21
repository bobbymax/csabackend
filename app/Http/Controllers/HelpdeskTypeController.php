<?php

namespace App\Http\Controllers;

use App\Http\Resources\HelpdeskTypeResource;
use App\Models\HelpdeskType;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class HelpdeskTypeController extends Controller
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
        return $this->success(HelpdeskTypeResource::collection(HelpdeskType::latest()->get()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'department_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors', 500);
        }

        $type = HelpdeskType::create([...$request->all(), 'label' => Str::slug($request->name)]);
        return $this->success(new HelpdeskTypeResource($type), 'Type created successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(HelpdeskType $helpdeskType): \Illuminate\Http\JsonResponse
    {
        return $this->success(new HelpdeskTypeResource($helpdeskType));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HelpdeskType $helpdeskType): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'department_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors', 500);
        }

        $helpdeskType->update([...$request->all(), 'label' => Str::slug($request->name)]);
        return $this->success(new HelpdeskTypeResource($helpdeskType), 'Type updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HelpdeskType $helpdeskType): \Illuminate\Http\JsonResponse
    {
        $helpdeskType->delete();
        return $this->success(null, 'Type deleted successfully!!');
    }
}
