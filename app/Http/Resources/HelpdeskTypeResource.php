<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HelpdeskTypeResource extends JsonResource
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
            'name' => $this->name,
            'label' => $this->label,
            'department' => [
                'id' => $this->department->id,
                'code' => $this->department->code,
                'name' => $this->department->name
            ],
            'description' => $this->description,
            'isDeactivated' => $this->isDeactivated == 1,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
