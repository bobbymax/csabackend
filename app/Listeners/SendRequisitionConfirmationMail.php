<?php

namespace App\Listeners;

//use App\Events\RequisitionConfirmed;
use App\Mail\RequisitionConfirmation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendRequisitionConfirmationMail
{
    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $requisition = $event->requisition;
        $user = $event->user;

        Mail::to($user->email)->queue(new RequisitionConfirmation($requisition));
    }
}
