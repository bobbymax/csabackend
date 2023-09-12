<?php

namespace App\Http\Controllers;

use App\Events\TaskAssigned;
use App\Http\Resources\TaskResource;
use App\Models\Requisition;
use App\Models\Task;
use App\Models\Ticket;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
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
//        return $this->success(TaskResource::collection(Task::where('department_id', Auth::user()->department_id)->latest()->get()));
        return $this->success(TaskResource::collection(Auth::user()->tasks));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'taskable_id' => 'required|integer',
            'assignee_id' => 'required|integer',
            'department_id' => 'required|integer',
            'activity' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'type' => 'required|string|max:30|in:staff,third-party',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors!!', 500);
        }

        $module = $this->getModule($request->activity, $request->taskable_id);

        if (! $module) {
            return $this->error(null, 'This ID does not exist', 422);
        }

        $task = new Task;
        $task->department_id = $request->department_id;
        $task->activity = $request->activity;
        $task->description = $request->description;
        $task->type = $request->type;

        if ($module->task()->save($task)) {
            $user = User::find($request->assignee_id);
            $user?->tasks()->save($task);

            TaskAssigned::dispatch($task, $user);
        }

        return $this->success(new TaskResource($task), 'Task has been assigned successfully!!', 201);
    }

    private function getModule($activity, $id)
    {
        return match($activity) {
            'requisition' => Requisition::find($id),
            'helpdesk' => Ticket::find($id),
        };
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task): \Illuminate\Http\JsonResponse
    {
        return $this->success(new TaskResource($task));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): \Illuminate\Http\JsonResponse
    {
        $task->staff()->detach();
        $task->delete();
        return $this->success(null, 'Task has been deleted successfully!!');
    }
}
