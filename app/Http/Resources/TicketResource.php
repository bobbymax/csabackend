<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            'code' => $this->code,
            'user_id' => $this->user_id,
            'support_id' => $this->support_id,
            'attributes' => [
                'staff' => [
                    'name' => $this->staff->firstname . " " . $this->staff->surname,
                    'staff_no' => $this->staff->staff_no
                ],
                'department' => [
                    'name' => $this->department->name,
                    'code' => $this->department->code
                ],
                'issue' => [
                    'name' => $this->issue->name,
                    'category' => $this->issue->category->name
                ],
                'location' => $this->location->name,
                'floor' => $this->floor->name,
                'task' => new TaskResource($this->task),
                'uploads' => $this->uploads
            ],
            'department_id' => $this->department_id,
            'owner_id' => $this->owner_id,
            'issue_id' => $this->issue_id,
            'location_id' => $this->location_id,
            'floor_id' => $this->floor_id,
            'office_number' => $this->office_number,
            'landmark' => $this->landmark,
            'description' => $this->description,
            'category' => $this->category,
            'priority' => $this->priority,
            'status' => $this->status,
            'escalated' => (int) $this->escalated,
            'closed' => $this->closed == 1,
            'created_at' => $this->created_at->format('d F, Y'),
            'updated_at' => $this->updated_at->format('d F, Y'),
        ];
    }
}
