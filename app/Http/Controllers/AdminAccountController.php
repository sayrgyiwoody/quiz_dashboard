<?php

namespace App\Http\Controllers;

use Storage;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return redirect()->route('admin.setting')->with(['updateAlert' => 'Admin information updated.']);


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
            'number' => 'max:20',
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
            'number' => $request->number,
            'address' => $request->address,
        ];
    }
}
