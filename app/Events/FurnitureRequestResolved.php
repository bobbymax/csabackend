<?php

namespace App\Events;

use App\Models\FurnitureRequest;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FurnitureRequestResolved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $furnitureRequest, $user;

    /**
     * Create a new event instance.
     */
    public function __construct(FurnitureRequest $furnitureRequest, User $user)
    {
        $this->furnitureRequest = $furnitureRequest;
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
