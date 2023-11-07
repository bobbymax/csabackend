<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockResource extends JsonResource
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
            'brand_id' => $this->brand_id,
            'brand' => $this->brand_id > 0 ? $this->brand->name : "None",
            'stock_type_id' => $this->stock_type_id,
            'type' => $this->type->name,
            'department_id' => $this->department_id,
            'department' => $this->department->code,
            'code' => $this->code,
            'name' => $this->name,
            'label' => $this->label,
            'quantity' => $this->quantity,
            'measure' => $this->measure,
            'items' => $this->items,
            'inStock' => $this->inStock,
            'restockable' => $this->restockable == 1,
            'restocks' => $this->restocks,
            'request_no_delivery' => $this->request_no_delivery,
            'tagIds' => $this->tags->pluck('id')->toArray(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
