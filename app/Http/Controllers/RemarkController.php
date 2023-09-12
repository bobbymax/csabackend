<?php

namespace App\Http\Controllers;

use App\Http\Resources\RequisitionResource;
use App\Models\Remark;
use App\Models\Requisition;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RemarkController extends Controller
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
        return $this->success(Remark::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|min:3',
            'remarkable_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $requisition = Requisition::find($request->remarkable_id);

        $remark = new Remark;
        $remark->description = $request->description;
        $remark->user_id = Auth::user()->id;

        if ($requisition?->remarks()->save($remark)) {
            $requisition->status = "in-review";
            $requisition->save();
        }

        return $this->success(new RequisitionResource($requisition), 'Remark has been added successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Remark $remark): \Illuminate\Http\JsonResponse
    {
        return $this->success($remark);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Remark $remark): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:completed',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $remark->update([
            'status' => $request->status,
        ]);

        return $this->success($remark, 'Remark updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Remark $remark): \Illuminate\Http\JsonResponse
    {
        $remark->delete();
        return $this->success(null, 'Remark deleted successfully!!');
    }
}
