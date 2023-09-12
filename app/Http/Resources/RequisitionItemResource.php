<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RequisitionItemResource extends JsonResource
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
            'product_name' => $this?->item?->name,
            'title' => $this?->item?->stock?->name,
            'stock_id' => $this?->item?->stock_id,
            'item_id' => $this->item_id,
            'item' => new ItemResource($this?->item),
            'priority' => $this->priority,
            'quantity_expected' => $this->quantity_expected,
            'quantity_received' => $this->quantity_received,
            'requisition_id' => $this->requisition_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
