<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceItemResource extends JsonResource
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
            'purchase_invoice_id' => $this->purchase_invoice_id,
            'item_id' => $this->item_id,
            'quantity' => $this->quantity,
            'amount' => $this->amount,
            'item' => [
                'name' => $this->item->name,
                'description' => $this->item->description
            ],
            'expiry_date' => Carbon::parse($this->expiry_date)->format('d F, Y'),
            'status' => $this->status,
            'created_at' => $this->created_at->format('d F, Y'),
            'updated_at' => $this->updated_at->format('d F, Y')
        ];
    }
}
