<?php

namespace App\Traits;

use App\Models\Department;
use App\Models\Task;

trait TaskLoad
{
    public function loadTask($obj, $desc, $activity, $type="staff", $code="FLD"): void
    {
        $department = Department::where('code', $code)->first();
        $task = new Task;
        $task->department_id = $department?->id;
        $task->activity = $activity;
        $task->description = $desc;
        $task->type = $type;
        $obj?->task()?->save($task);
    }
}
