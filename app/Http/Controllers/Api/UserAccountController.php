<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateInfoRequest;

class UserAccountController extends Controller
{
    //get profile info
    public function getProfileInfo(){
        $user = User::select('name','email','gender','number','address','profile_photo_path')
        ->where('id',Auth::user()->id)->first();
        return response()->json(['status'=>true,'user'=>$user], 200);

    }

    //get profile info
    public function updateProfileInfo(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:20',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email,' . Auth::user()->id,],
            'gender' => 'required',
            'image' => 'mimes:png,jpg,jpeg|file',
            'number' => 'max:20',
            'address' => 'max:100',
        ]);

        // for more secure file upload 
        $validator->after(function ($validator) use ($request) {
            $image = $request->file('image');

            if ($image) {
                $extension = strtolower($image->getClientOriginalExtension());
                $allowedExtensions = ['png', 'jpg', 'jpeg'];

                if (!in_array($extension, $allowedExtensions)) {
                    $validator->errors()->add('image', 'Invalid image file.');
                }
            }
        });

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        }else {
            $data = $this->getAccountData($request);

        if($request->hasFile('image')) {
            $dbImage = User::select('profile_photo_path')->where('id',Auth::user()->id)->first();
            $dbImage =$dbImage->profile_photo_path;
            if($dbImage!=null) {
                Storage::delete('public/'.$dbImage);
            }
            $imageName = uniqid() . $request->file('image')->getClientOriginalName();
            $data['profile_photo_path'] = $imageName;
            $request->file('image')->storeAs('public/',$imageName);
        }

        User::where('id',Auth::user()->id)->update($data);
        $user = User::where('id',Auth::user()->id)->get();
        return response()->json(['userInfo'=>$user ,'status' => 'success','message' => 'Your personal information is updated successfully'], 200);
        }


    }



    //get account data as object format
    private function getAccountData($request) {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'updated_at' => Carbon::now(),
            'gender' => $request->gender,
            'number' => $request->number,
            'address' => $request->address,
        ];
    }

    //Change new password
    public function changePassword(ChangePasswordRequest $request) {
        // $this->passwordValidationCheck($request);
        $dbHashPassword = Auth::user()->password;
        if(Hash::check($request->oldPassword, $dbHashPassword)) {
            $newPassword = hash::make($request->newPassword);
            $user = User::where('id',Auth::user()->id)->update([
                'password' => $newPassword
            ]);
            return response()->json(['status' => 'success','message'=>'Password changed successfully'], 200);

        }else {
            return response()->json([
                'status' => 'fail',
                'message' => [
                    'oldPassword' => ['Incorrect old password']
                ],
            ],200);
        }

    }

    // delete account
    public function deleteAccount(){
        $dbImage = User::select('profile_photo_path')->where('id',Auth::user()->id)->first();
            $dbImage =$dbImage->profile_photo_path;
            if($dbImage!=null) {
                Storage::delete('public/'.$dbImage);
            }
        User::where('id',Auth::user()->id)->delete();
        return response()->json(200);
    }
}
