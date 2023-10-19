<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
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
            'staff' => $this->staff->firstname . " " . $this->staff->surname,
            'logistics_request_id' => $this->logistics_request_id,
            'user_id' => $this->user_id,
            'request_type' => $this->request_type,
            'type' => $this->type,
            'flight_type' => $this->flight_type,
            'name' => $this->name,
            'mobile' => $this->mobile,
            'take_off' => $this->take_off,
            'destination' => $this->destination,
            'begin' => Carbon::parse($this->begin)->format('d F Y'),
            'elapse' => Carbon::parse($this->elapse)->format('d F Y'),
            'duration' => $this->duration,
            'approval_memo' => $this->approval_memo,
            'data_page' => $this->data_page,
            'instructions' => $this->instructions,
            'attributes' => [
                'itineraries' => $this->consonances,
                'count' => $this->consonances->count(),
                'accepted' => $this->consonances->where('status', 'accepted')->first()
            ],
            'visa' => $this->visa,
            'status' => $this->status,
            'stage' => $this->stage,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
