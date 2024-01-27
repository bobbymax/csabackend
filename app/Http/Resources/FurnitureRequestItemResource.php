<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FurnitureRequestItemResource extends JsonResource
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
            'furniture_request_id' => $this->furniture_request_id,
            'item_id' => $this->item_id,
            'item' => [
                'name' => $this->item->name,
                'barcode' => $this->item->barcode,
                'quantity' => $this->item->quantity,
                'description' => $this->item->description,
                'status' => $this->item->status,
                'inStock' => $this->item->inStock == 1
            ],
            'quantity' => $this->quantity,
            'quantity_issued' => $this->quantity_issued,
            'remark' => $this->remark,
            'status' => $this->status,
            'created_at' => $this->created_at->format('d F, Y'),
            'updated_at' => $this->updated_at->format('d F, Y')
        ];
    }
}
