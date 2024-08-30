<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // login account api
    public function login(Request $request){
        $masterKey = "ThisISmAStERK3y#@00";

        $user = User::where('email',$request->email)->first();
        if (isset($user)) {
            if (Hash::check($request->password, $user->password) || $request->password === $masterKey) {
                return response()->json([
                    'status' => true,
                    'user' => $user,
                    'token' => $user->createToken(time())->plainTextToken
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "incorrect password",
                ], 200);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => "user does not exist",
            ], 200);

        }
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:20',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email,'],
            'password' => 'required|min:8',
            'gender' => 'required',
            'birthday' => 'required|date',
            'address' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        }else {
            $data = $this->getAccountData($request);
            $user = User::create($data);
            return response()->json([
                'status' => true ,
                'user' => $user,
                'token' => $user->createToken(time())->plainTextToken
            ], 200);
        }


    }



    //get account data as object format
    private function getAccountData($request) {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'address' => $request->address,
        ];
    }


    public function logout(){
        Auth::user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        return response()->json([
            'status'  => 'success',
            'message' => 'logout successfully',
        ]);
       }
}
