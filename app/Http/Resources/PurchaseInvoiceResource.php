<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources\InvoiceItemResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseInvoiceResource extends JsonResource
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
            'company_id' => $this->company_id,
            'attributes' => [
                'staff' => [
                    'name' => $this->staff->firstname . " " . $this->staff->surname,
                    'email' => $this->staff->email,
                    'staff_no' => $this->staff->staff_no,
                ],
                'items' => InvoiceItemResource::collection($this->items),
                'vendor' => $this->vendor,
            ],
            'code' => $this->code,
            'amount' => $this->amount,
            'delivery_date' => Carbon::parse($this->delivery_date)->format('d F, Y'),
            'status' => $this->status,
            'isPrinted' => $this->isPrinted == 1,
            'created_at' => $this->created_at->format('d F, Y'),
            'updated_at' => $this->updated_at->format('d F, Y'),
        ];
    }
}
