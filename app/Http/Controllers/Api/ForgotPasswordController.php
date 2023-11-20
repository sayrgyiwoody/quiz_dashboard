<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class forgotPasswordController extends Controller
{
    public function requestPassword(Request $request) {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|exists:users,email'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        }else {
            DB::table('password_reset_tokens')
            ->where([
                'email' => $request->email
            ])->delete();

            $token = Str::random(64);
            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);


            $action_link = route('reset.password.form',['token'=>$token,'email'=>$request->email]);
            $body = "We are received a request to reset the password for <b>Quiz App</b> account associated with " .$request->email .
            ". You can reset your password by clicking the link below";

            Mail::send('email-forgot',['action_link'=>$action_link,'body'=>$body],function($message) use ($request){
                $message->from('test@gmail.com','quiz app');
                $message->to($request->email,'quiz app')
                        ->subject('Reset Password');
            });

            return response()->json([
                'status' => true,
                'message' => 'We have e-mailed your password reset link! Check your mail inbox.'
            ], 200);
        }


    }
}
