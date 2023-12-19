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
        Participant::where('user_id',Auth::user()->id)->delete();
        $room = Room::where('room_code',$request->room_code)->first();
        if($room){

            $participant = Participant::where('user_id',Auth::user()->id)->first();
            if(!$participant){
                Participant::create([
                    'room_id' => $room->room_id,
                    'user_id' => Auth::user()->id,
                    'is_host' => 0,
                ]);
            }

            $user = User::where('id',Auth::user()->id)->first();

            Broadcast(new ParticipantJoined($user,$request->room_code));

            return response()->json(['status'=>true], 200);
        }else {
            return response()->json(['status'=>false,'message'=>"Room not found"], 200);
        }
    }

    public function getRoomInfo(Request $request){
        $room = Room::where('room_code',$request->room_code)->first();
        if($room){
            $participants = Participant::select('participants.*','users.profile_photo_path','users.provider_avatar')
                ->leftJoin('users','participants.user_id','users.id')
                ->where('room_id',$room->room_id)
                ->where('is_host',0)
                ->orderBy('created_at','desc')->get();
            $host = Participant::select('participants.*','users.name','users.profile_photo_path','users.provider_avatar')
                ->leftJoin('users','participants.user_id','users.id')
                ->where('room_id',$room->room_id)
                ->where('is_host',1)
                ->first();

                $isCurrentUserHost = Participant::where('user_id', Auth::user()->id)->where('is_host', 1)->exists();

            return response()->json(['status'=>true,'host'=>$host,'participants'=>$participants,'isCurrentUserHost'=>$isCurrentUserHost], 200);
        }else {
            return response()->json(['status'=>false,'message'=>'room does not exist'], 200);

        }

    }

    public function endRoom(Request $request){
        $room = Room::where('room_code',$request->room_code)->where('host_id',Auth::user()->id)->first();
        Room::where('room_code',$request->room_code)->delete();
        Participant::where('room_id',$room->room_id)->delete();
        return response()->json(['status'=>true], 200);
    }
}
