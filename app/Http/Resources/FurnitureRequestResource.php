<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FurnitureRequestResource extends JsonResource
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
            'user_id' => $this->user_id,
            'location_id' => $this->location_id,
            'code' => $this->code,
            'attributes' => [
                'items' => FurnitureRequestItemResource::collection($this->items),
                'location' => $this->location->name,
                'staff' => [
                    'name' => $this->staff->firstname . " " . $this->staff->surname,
                    'staff_no' => $this->staff->staff_no,
                    'grade_level' => $this->staff->level->key,
                    'department' => $this->staff->department->code,
                ],
                'task' => new TaskResource($this->task)
            ],
            'description' => $this->description,
            'type' => $this->type,
            'status' => $this->status,
            'closed' => $this->closed == 1,
            'created_at' => $this->created_at->format('d F, Y'),
            'updated_at' => $this->updated_at->format('d F, Y'),
        ];
    }
}
