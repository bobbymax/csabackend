<?php

namespace App\Listeners;

use App\Mail\RequisitionApproved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendRequisitionApprovedMail
{
    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $requisition = $event->requisition;
        $user = $event->user;

        Mail::to($user->email)->queue(new RequisitionApproved($requisition));
    }
}
