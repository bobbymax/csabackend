<?php

namespace App\Http\Controllers;

use App\Events\RequisitionApproved;
use App\Events\RequisitionConfirmed;
use App\Http\Resources\RequisitionResource;
use App\Models\Requisition;
use App\Models\RequisitionItem;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RequisitionController extends Controller
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
        return $this->success(RequisitionResource::collection(Requisition::where('user_id', Auth::user()->id)->latest()->get()));
    }

    public function getPendingRequisitions(): \Illuminate\Http\JsonResponse
    {
        return $this->success(RequisitionResource::collection(Requisition::where('status', 'registered')->latest()->get()));
    }

    public function getRequisitionsForApproval(): \Illuminate\Http\JsonResponse
    {
        return $this->success(RequisitionResource::collection(Requisition::where('status', 'pending')->where('department_id', Auth::user()->department_id)->latest()->get()));
    }

    public function getProgressRequisitions(): \Illuminate\Http\JsonResponse
    {
        return $this->success(RequisitionResource::collection(Requisition::where('status', 'in-progress')->latest()->get()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'department_id' => 'required|integer',
            'location_id' => 'required|integer',
            'code' => 'required|string|max:255|unique:requisitions',
            'type' => 'required|string|max:30|in:quota,request',
            'request_type' => 'required|string|max:30|in:self,third-party',
            'items' => 'required|array'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $requisition = Requisition::create($request->except('items', 'id'));

        foreach ($request->items as $item) {
            RequisitionItem::create([
                'requisition_id' => $requisition->id,
                'item_id' => $item['item_id'],
                'quantity_expected' => $item['quantity_expected'],
                'priority' => $item['priority']
            ]);
        }

        return $this->success(new RequisitionResource($requisition), 'Requisition request created successfully!!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Requisition $requisition): \Illuminate\Http\JsonResponse
    {
        return $this->success(new RequisitionResource($requisition));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Requisition $requisition): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'location_id' => 'required|integer',
            'type' => 'required|string|max:30|in:quota,request',
            'request_type' => 'required|string|max:30|in:self,third-party',
            'status' => 'required|string|in:pending',
            'items' => 'required|array'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $requisition->update($request->except('items'));
        $requisition->items()->delete();

        foreach ($request->items as $item) {
            RequisitionItem::create([
                'requisition_id' => $requisition->id,
                'item_id' => $item['item_id'],
                'quantity_expected' => $item['quantity_expected'],
                'priority' => $item['priority']
            ]);
        }

        return $this->success(new RequisitionResource($requisition), 'Requisition request updated successfully!!');
    }

    public function updateStatus(Request $request, Requisition $requisition): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|max:255|in:registered,in-progress,authorized,cancelled,approved,denied'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $requisition->update($request->only('status'));

        if ($request->status === "registered" || $request->status === "approved") {
            match ($request->status) {
                "registered" => RequisitionApproved::dispatch($requisition, $requisition->staff),
                "approved" => RequisitionConfirmed::dispatch($requisition, $requisition->staff),
            };
        }

        if ($requisition->task !== null && ($request->status === "approved" || $request->status === "denied")) {
            $task = $requisition->task;

            $task->status = "completed";
            $task->save();
        }

        return $this->success(new RequisitionResource($requisition), 'Requisition Status updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Requisition $requisition): \Illuminate\Http\JsonResponse
    {
        $requisition->delete();
        return $this->success(null, 'Requisition request deleted successfully!!');
    }
}
