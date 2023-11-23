<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\SavedQuiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AdminAccountController extends Controller
{
    //Update account information
    public function updateAccount(Request $request) {


        $this->accountValidationCheck($request);

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
        return redirect()->route('admin.setting')->with(['alert' => 'Your personal information is updated successfully.']);


    }

    //Account input validation check
    private function accountValidationCheck($request) {
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
            'birthday' => 'date',
            'address' => 'max:100',
        ]);

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
            throw new ValidationException($validator);
        }
    }

    //get account data as object format
    private function getAccountData($request) {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'updated_at' => Carbon::now(),
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'address' => $request->address,
        ];
    }

    //Change new password
    public function changePassword(Request $request) {
        $this->passwordValidationCheck($request);
        $dbHashPassword = Auth::user()->password;
        if(Hash::check($request->oldPassword, $dbHashPassword)) {
            $newPassword = hash::make($request->newPassword);
            $user = User::where('id',Auth::user()->id)->update([
                'password' => $newPassword
            ]);
            return redirect()->route('admin.setting')->with(['alert'=>'Your account password is changed successfully']);

        }else {
            return redirect()->back()->withErrors(['oldPassword' => 'Incorrect old password']);
        }

    }

    //check password validation
    private function passwordValidationCheck($request) {
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:8',
            'newPassword' => 'required|min:8',
            'confirmPassword' => 'required|min:8|same:newPassword'
        ])->validate();
    }

    // delete account
    public function deleteAccount(){
        $dbImage = User::select('profile_photo_path')->where('id',Auth::user()->id)->first();
            $dbImage =$dbImage->profile_photo_path;
            if($dbImage!=null) {
                Storage::delete('public/'.$dbImage);
            }
        SavedQuiz::where('user_id',Auth::user()->id)->delete();
        User::where('id',Auth::user()->id)->delete();
        return response()->json(200);
    }
}
