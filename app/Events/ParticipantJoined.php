<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ParticipantJoined implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $participant;
    public $room_code;

    public function __construct($participant,$room_code)
    {
        $this->participant = $participant;
        $this->room_code = $room_code;
    }

    public function broadcastWith(){
        return [
            'participant' => $this->participant
        ];
    }

    public function broadcastOn()
    {
        return new Channel('room.' . $this->room_code);
    }
}
