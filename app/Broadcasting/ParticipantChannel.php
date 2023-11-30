<?php

namespace App\Broadcasting;

use App\Models\Room;
use App\Models\User;

class ParticipantChannel
{
    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\Models\User  $user
     * @param  string  $roomCode
     * @return array|bool
     */
    public function join(User $user, $roomCode)
    {
        // Check if the user is a participant in the room
        $room = Room::where('room_code', $roomCode)->where('user_id',$user->id)->first();

        if ($room) {
            return ['id' => $user->id, 'name' => $user->name];
        }

        return false;
    }
}
