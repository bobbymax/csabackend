<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LogisticsRequestResource extends JsonResource
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
            'code' => $this->code,
            'budget_code' => $this->budget_code,
            'cost' => $this->cost,
            'description' => $this->description,
            'status' => $this->status,
            'attributes' => [
                'requisitor' => [
                    'name' => $this->staff->firstname . " " . $this->staff->surname,
                    'staff_no' => $this->staff->staff_no,
                    'grade_level' => $this->staff->level->key
                ],
                'reservations' => ReservationResource::collection($this->reservations),
                'task' => new TaskResource($this->task)
            ],
            'closed' => $this->closed == 1,
            'created_at' => $this->created_at->format('d F Y'),
            'updated_at' => $this->updated_at->format('d F Y')
        ];
    }
}
