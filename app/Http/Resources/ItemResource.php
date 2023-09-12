<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
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
            'stock_id' => $this->stock_id,
            'location_id' => $this->location_id,
            'barcode' => $this->barcode,
            'name' => $this->name,
            'quantity' => $this->quantity,
            'description' => $this->description,
            'color' => $this->feature?->color,
            'tank_capacity' => $this->feature?->tank_capacity,
            'insurance_due_date' => $this->feature?->insurance_due_date,
            'due_for_servicing' => $this->feature?->due_for_servicing,
            'insurance_due' => $this->feature?->insurance_due,
            'insurance_status' => $this->feature?->insurance_status,
            'hasFeature' => $this->feature !== null,
            'inStock' => $this->inStock,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
