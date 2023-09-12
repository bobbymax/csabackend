<?php

namespace App\Listeners;

use App\Mail\TaskConfirmation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendTaskAssignedConfirmationEmail
{
    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $task = $event->task;
        $user = $event->user;

        // send out confirmation email with details of task
        Mail::to($user->email)->queue(new TaskConfirmation($task));
    }
}
