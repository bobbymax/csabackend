<?php

namespace App\Http\Controllers;

use App\Http\Resources\TicketResource;
use App\Models\Company;
use App\Models\Task;
use App\Models\Ticket;
use App\Models\Todo;
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
        return $this->success(TicketResource::collection(Ticket::where('user_id', Auth::user()->id)->latest()->get()));
    }

    public function complaints(): \Illuminate\Http\JsonResponse
    {
        return $this->success(TicketResource::collection(Ticket::where('owner_id', Auth::user()->department_id)->latest()->get()));
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
            'owner_id' => 'required|integer',
            'location_id' => 'required|integer',
            'floor_id' => 'required|integer',
            'code' => 'required|string|max:15|unique:tickets',
            'category' => 'required|string|max:255|in:incident,support,other',
            'priority' => 'required|string|max:255|in:low,medium,high',
            'description' => 'required|min:3'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 500);
        }

        $ticket = Ticket::create($request->all());
        return $this->success(new TicketResource($ticket), 'Ticket request has been logged successfully!!', 201);
    }

    public function manage(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'auth_id' => 'required|integer',
            'ticket_id' => 'required|integer',
            'task_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:255|in:escalated,todo',
            'description' => 'required|min:3'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 500);
        }

        $ticket = Ticket::find($request->ticket_id);
        $task = Task::find($request->task_id);
        $user = User::find($request->user_id);

        if ($ticket && $task && $user) {
            $ticket->status = $request->status === "todo" ? "ongoing" : $request->status;
            $ticket->support_id = $request->user_id;
            if ($request->status === "escalated") {
                $ticket->escalated += 1;
                $task->staff()->save($user);
            }

            if ($ticket->save()) {
                $todo = new Todo;
                $todo->name = $request->name;
                $todo->description = $request->description;
                $todo->user_id = $request->auth_id;
                $todo->status = $request->status === "escalated" ? "completed" : "pending";
                $task->todos()->save($todo);
            }
        }

        return $this->success(new TicketResource($ticket), 'Ticket updated successfully!!');
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

        return $this->success(new TicketResource($ticket), 'This ticket has been assign successfully!');
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
        return $this->success(new TicketResource($ticket));
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
            'owner_id' => 'required|integer',
            'floor_id' => 'required|integer',
            'related_issue_id' => 'required',
            'description' => 'required|min:3'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 500);
        }

        $ticket->update($request->except('user_id', 'code'));
        return $this->success(new TicketResource($ticket), 'Ticket request has been updated successfully!!');
    }

    public function resolveTicket(Request $request, Ticket $ticket): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|max:255|in:completed'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 500);
        }

        $ticket->status = "resolved";
        $ticket->save();

        $ticket->task->status = $request->status;
        $ticket->task->save();

        return $this->success(new TicketResource($ticket), 'Ticket has been resolved successfully!!');
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
