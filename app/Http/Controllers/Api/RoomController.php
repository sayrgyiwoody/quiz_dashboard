<?php

namespace App\Http\Controllers\Api;

use App\Models\Room;
use App\Models\User;
use App\Models\Participant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Events\ParticipantJoined;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

class RoomController extends Controller
{
    //generate room code
    public function generateRoom(Request $request){
        Room::where('host_id',Auth::user()->id)->delete();
        $room = Room::create([
            'room_code' => Str::random(6),
            'quiz_id' => $request->quiz_id,
            'host_id' => Auth::user()->id,
            'status' => 1
        ]);

        Participant::where('user_id',Auth::user()->id)->delete();
        Participant::create([
            'room_id' => $room->id,
            'user_id' => Auth::user()->id,
            'is_host' => 1,
        ]);

        return response()->json(['status'=>true,'room'=>$room], 200);
    }

    public function joinRoom(Request $request){
        $room = Room::where('room_code',$request->room_code)->first();
        if($room){

            $user = User::where('id',Auth::user()->id)->first();

            Broadcast(new ParticipantJoined($user,$request->room_code));

            return response()->json(['status'=>true,'user'=>$user], 200);
        }else {
            return response()->json(['status'=>false,'message'=>"Room not found"], 200);
        }
    }
}
