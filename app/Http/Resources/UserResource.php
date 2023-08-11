<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'grade_level_id' => $this->grade_level_id,
            'department_id' => $this->department_id,
            'staff_type_id' => $this->staff_type_id,
            'availability_id' => $this->availability_id,
            'location_id' => $this->location_id,
            'company_id' => $this->company_id,
            'firstname' => $this->firstname,
            'middlename' => $this->middlename,
            'surname' => $this->surname,
            'name' => $this->firstname . " " . $this->surname,
            'staff_no' => $this->staff_no,
            'email' => $this->email,
            'staff_type' => $this->type->name,
            'location' => $this->location->name,
            'grade_level' => $this->level->key,
            'department' => $this->department->code,
            'company' => $this->company->name,
            'status' => $this->status->name,
            'groups' => $this->groups,
        ];
    }
}
