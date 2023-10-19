<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'department_id' => $this->department_id,
            'activity' => $this->activity,
            'taskable_id' => $this->taskable_id,
            'taskable_type' => $this->taskable_type,
            'description' => $this->description,
            'status' => $this->status,
            'owner' => $this->taskable,
            'assignees' => $this->staff->pluck('id')->toArray(),
            'raised_at' => Carbon::parse($this->created_at)->diffForHumans(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
