<?php

namespace App\Listeners;

use App\Mail\FurnitureRequestResolution;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendFurnitureRequestResolutionMail
{
    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $furnitureRequest = $event->furnitureRequest;
        $user = $event->user;

        Mail::to($user->email)->queue(new FurnitureRequestResolution($furnitureRequest));
    }
}
