<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ComplaintController extends Controller
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
        return $this->success(Complaint::where('user_id', Auth::user()->id)->latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'item_id' => 'required|integer',
            'type' => 'required|string|max:30|in:service,repair,incident',
            'description' => 'required|min:3',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $complaint = Complaint::create($request->all());
        return $this->success($complaint, 'Complaint filed successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Complaint $complaint): \Illuminate\Http\JsonResponse
    {
        return $this->success($complaint);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Complaint $complaint): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'item_id' => 'required|integer',
            'type' => 'required|string|max:30|in:service,repair,incident',
            'description' => 'required|min:3',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $complaint->update($request->all());
        return $this->success($complaint, 'Complaint updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Complaint $complaint): \Illuminate\Http\JsonResponse
    {
        $complaint->delete();
        return $this->success(null, 'Complaint deleted successfully!!');
    }
}
