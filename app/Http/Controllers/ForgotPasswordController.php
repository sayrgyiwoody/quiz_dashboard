<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    public function sendResetLink(Request $request) {
        Validator::make($request->all(),[
            'email' => 'required|email|exists:users,email'
        ])->validate();

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

        return back()->with('message_sent','We have e-mailed your password reset link!');
    }

    public function showResetForm(Request $request, $token = null) {
        return view('auth.reset-password')->with(['token'=>$token,'email'=>$request->email]);
    }

    public function resetPassword(Request $request) {
        Validator::make($request->all(),[
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required'
        ])->validate();

        $check_token = DB::table('password_reset_tokens')
        ->where([
            'email' => $request->email,
            'token' => $request->token
        ])->first();

        if(!$check_token) {
            return back()->withInput()->with('fail','Invalid token or request time out!');
        }else {
            User::where('email',$request->email)
            ->update([
                'password' => Hash::make($request->password)
            ]);

            DB::table('password_reset_tokens')
            ->where([
                'email' => $request->email
            ])->delete();

            return redirect()->back()->with('info','Your password has been changed! You can login with new password ')
            ->with('verifiedEmail',$request->email);
        }

    }

    public function passwordRequestPage(){
        return view('setting.password-request');
    }
}
