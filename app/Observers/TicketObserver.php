<?php

namespace App\Observers;

use App\Events\SupportTicketCreated;
use App\Models\Ticket;
use App\Traits\TaskLoad;

class TicketObserver
{
    use TaskLoad;
    /**
     * Handle the Ticket "created" event.
     */
    public function created(Ticket $ticket): void
    {
        $dept = $ticket->category === "incident" ? "FLD" : "ICT";
        $this->loadTask($ticket, "Handle request with code " . $ticket->code, $ticket->category, "staff", $dept);

        SupportTicketCreated::dispatch($ticket, $ticket->staff);
    }

    /**
     * Handle the Ticket "updated" event.
     */
    public function updated(Ticket $ticket): void
    {
        //
    }

    /**
     * Handle the Ticket "deleted" event.
     */
    public function deleted(Ticket $ticket): void
    {
        //
    }

    /**
     * Handle the Ticket "restored" event.
     */
    public function restored(Ticket $ticket): void
    {
        //
    }

    /**
     * Handle the Ticket "force deleted" event.
     */
    public function forceDeleted(Ticket $ticket): void
    {
        //
    }
}
