<?php

namespace App\Events;

use App\Models\Requisition;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RequisitionApproved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $requisition, $user;

    /**
     * Create a new event instance.
     */
    public function __construct(Requisition $requisition, User $user)
    {
        $this->requisition = $requisition;
        $this->user = $user;
    }
}
