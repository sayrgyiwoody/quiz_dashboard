<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SavedQuiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AccountsController extends Controller
{
    //get admin account lists
    public function adminList(){
        $admins = User::where(function($query) {
            $query->where('role', 'admin')
                  ->where(function($subQuery) {
                      $subQuery->where('name', 'like', '%' . request('searchKey') . '%')
                               ->orWhere('email', 'like', '%' . request('searchKey') . '%');
                  });
        });
        if(request('filterStatus') == "ascending"){
            $admins = $admins->orderBy('created_at','asc')->paginate(8);
        }else  if(request('filterStatus') == "AZ"){
            $admins = $admins->orderBy('name','asc')->paginate(8);
        }else {
            $admins = $admins->orderBy('created_at','desc')->paginate(8);
        }
        return view('accounts.admin-list',compact('admins'));
    }

    //get admin account lists
    public function userList(){

        $users = User::where(function($query) {
            $query->where('role', 'user')
                  ->where(function($subQuery) {
                      $subQuery->where('name', 'like', '%' . request('searchKey') . '%')
                               ->orWhere('email', 'like', '%' . request('searchKey') . '%');
                  });
        });

        if(request('filterStatus') == "ascending"){
            $users = $users->orderBy('created_at','asc')->paginate(8);
        }else  if(request('filterStatus') == "AZ"){
            $users = $users->orderBy('name','asc')->paginate(8);
        }else {
            $users = $users->orderBy('created_at','desc')->paginate(8);
        }
        return view('accounts.user-list',compact('users'));
    }

    // delete account
    public function delete(Request $request){
        $dbImage = User::select('profile_photo_path')->where('id',$request->id)->first();
        $dbImage =$dbImage->profile_photo_path;
        if($dbImage!=null) {
            Storage::delete('public/'.$dbImage);
        }
        SavedQuiz::where('user_id',$request->id)->delete();
        User::where('id',$request->id)->delete();
        return  redirect()->back()->with(["alert"=>"Account deleted successfully"]);
    }

    // change role of account
    public function changeRole(Request $request){
        $user = User::where('id',$request->id)->first();
        if($user->role == "admin"){
            User::where('id',$request->id)->update(["role"=>"user"]);
        }else if($user->role == "user"){
            User::where('id',$request->id)->update(["role"=>"admin"]);
        }
        return  redirect()->back()->with(["alert"=>"Account Role Changed successfully"]);
    }
}
