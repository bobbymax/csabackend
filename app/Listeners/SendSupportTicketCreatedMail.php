<?php

namespace App\Listeners;

use App\Mail\SupportTicketOpened;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendSupportTicketCreatedMail
{
    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $ticket = $event->ticket;
        $user = $event->user;

        Mail::to($user->email)->queue(new SupportTicketOpened($ticket));
    }
}
