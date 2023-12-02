<?php

namespace App\Broadcasting;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class RoomChannel implements ShouldBroadcastNow
{
    public $roomCode;
    /**
     * Create a new channel instance.
     */
    public function __construct($roomCode)
    {
        $this->roomCode = $roomCode;
    }

    public function broadcastOn()
    {
        return new PresenceChannel('room.' . $this->roomCode);
    }

    /**
     * Authenticate the user's access to the channel.
     */
    public function join(User $user): array|bool
    {
        return true;
    }
}
