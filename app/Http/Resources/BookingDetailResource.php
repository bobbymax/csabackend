<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingDetailResource extends JsonResource
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
            'booking_id' => $this->booking_id,
            'user_id' => $this->user_id,
            'staff' => $this->contact->firstname . " " . $this->contact->surname,
            'attributes' => [
                'room' => $this->room,
                'contact' => $this->contact,
                'seating' => $this->seatingArrangement
            ],
            'room_id' => $this->room_id,
            'room_name' => $this->room->name,
            'staff_name' => $this->contact->firstname . " " . $this->contact->surname,
            'seating_id' => $this->seating_id,
            'start' => Carbon::parse($this->start)->format('d M y, H:i'),
            'finish' => Carbon::parse($this->finish)->format('d M y, H:i'),
            'duration' => $this->duration,
            'pa_system' => $this->pa_system == 1,
            'audio_visual_system' => $this->audio_visual_system == 1,
            'internet' => $this->internet == 1,
            'tea_snacks' => $this->tea_snacks == 1,
            'breakfast' => $this->breakfast == 1,
            'lunch' => $this->lunch == 1,
            'description' => $this->description,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
