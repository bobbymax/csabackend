<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
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
            'attributes' => [
                'task' => new TaskResource($this->task),
                'details' => BookingDetailResource::collection($this->details)
            ],
            'user_id' => $this->user_id,
            'staff' => $this->staff->firstname . " " . $this->staff->surname,
            'title' => $this->title,
            'code' => $this->code,
            'budget_code' => $this->budget_code,
            'start' => Carbon::parse($this->start)->format('d M y, H:i'),
            'finish' => Carbon::parse($this->finish)->format('d M y, H:i'),
            'duration' => $this->duration,
            'description' => $this->description,
            'remark' => $this->remark,
            'status' => $this->status,
            'closed' => $this->closed == 1,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
