<?php

namespace App\Observers;

use App\Models\Booking;
use App\Traits\TaskLoad;

class BookingObserver
{
    use TaskLoad;

    /**
     * Handle the Booking "created" event.
     */
    public function created(Booking $booking): void
    {
        $this->loadTask($booking, "Handle request with code " . $booking?->code, "meetings");
    }

    /**
     * Handle the Booking "updated" event.
     */
    public function updated(Booking $booking): void
    {
        //
    }

    /**
     * Handle the Booking "deleted" event.
     */
    public function deleted(Booking $booking): void
    {
        //
    }

    /**
     * Handle the Booking "restored" event.
     */
    public function restored(Booking $booking): void
    {
        //
    }

    /**
     * Handle the Booking "force deleted" event.
     */
    public function forceDeleted(Booking $booking): void
    {
        //
    }
}
