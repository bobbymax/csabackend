<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Task;
use App\Models\Ticket;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
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
        return $this->success(Ticket::where('user_id', Auth::user()->id)->latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'department_id' => 'required|integer',
            'issue_id' => 'required|integer',
            'location_id' => 'required|integer',
            'floor_id' => 'required|integer',
            'related_issue_id' => 'required',
            'code' => 'required|string|max:8|unique:tickets',
            'category' => 'required|string|max:255|in:incident,support,other',
            'description' => 'required|min:3'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 500);
        }

        $ticket = Ticket::create($request->all());
        return $this->success($ticket, 'Ticket request has been logged successfully!!', 201);
    }

    public function assign(Request $request, Ticket $ticket): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'taskable_id' => 'required|integer',
            'taskable_type' => 'required|string|max:255|in:staff,contractor',
            'department_id' => 'required|integer',
            'activity' => 'required|min:3'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 500);
        }

        $task = new Task;
        $task->department_id = $request->department_id;
        $task->activity = $request->activity;

        if ($ticket->task()->save($task)) {
            $taskable = $this->getTaskable($request->taskable_type, $request->taskable_id);
            $taskable?->tasks()->save($task);
        }

        return $this->success($ticket, 'This ticket has been assign successfully!');
    }

    private function getTaskable($type, $taskable)
    {
        return match ($type) {
            'contractor' => Company::find($taskable),
            default => User::find($taskable)
        };
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket): \Illuminate\Http\JsonResponse
    {
        return $this->success($ticket);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'department_id' => 'required|integer',
            'issue_id' => 'required|integer',
            'location_id' => 'required|integer',
            'floor_id' => 'required|integer',
            'related_issue_id' => 'required',
            'description' => 'required|min:3'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 500);
        }

        $ticket->update($request->except('user_id', 'code'));
        return $this->success($ticket, 'Ticket request has been updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket): \Illuminate\Http\JsonResponse
    {
        $ticket->delete();
        return $this->success(null, 'Ticket request has been deleted successfully!!');
    }
}
