<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RequisitionResource extends JsonResource
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
            'department_id' => $this->department_id,
            'location_id' => $this->location_id,
            'code' => $this->code,
            'type' => $this->type,
            'request_type' => $this->request_type,
            'department_name' => $this->department?->code,
            'requisitor' => $this->staff->firstname . " " . $this->staff->surname,
            'description' => $this->description,
            'attributes' => [
                'items' => RequisitionItemResource::collection($this->items),
                'department' => $this->department,
                'remarks' => $this->remarks,
                'task' => new TaskResource($this->task),
            ],
            'status' => $this->status,
            'closed' => $this->closed,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
