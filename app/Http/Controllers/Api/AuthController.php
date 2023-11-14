<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // login account api
    public function login(Request $request){
        $user = User::where('email',$request->email)->first();
        if(isset($user)){
            if(Hash::check($request->password, $user->password)){
                return response()->json([
                    'status' => true ,
                    'user' => $user,
                    'token' => $user->createToken(time())->plainTextToken
                ], 200);
            }else {
                return response()->json([
                    'status' => false ,
                    'message' => "incorrect password",
                ], 200);
            }
        }else {
            return response()->json([
                'status' => false ,
                'message' => "user does not exist",
            ], 200);
        }
    }

    public function validateToken(){
        return response()->json([
            'status' => 'true'
        ], 200);
    }


}
