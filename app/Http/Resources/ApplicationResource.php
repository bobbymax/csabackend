<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'icon' => $this->icon,
            'code' => $this->code,
            'path' => $this->path,
            'description' => $this->description,
            'modules' => $this->modules,
            'departments' => $this->departments,
            'groups' => $this->groups,
            'allowedDepartments' => $this->departments->pluck('id')->toArray(),
            'allowedGroups' => $this->groups->pluck('id')->toArray(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
