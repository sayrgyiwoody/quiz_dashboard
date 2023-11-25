<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function dashboard () {
        $category_count = Category::get()->count();
        $admin_count = User::where('role','admin')->get()->count();
        $user_count = User::where('role','user')->get()->count();
        $quiz_count = Quiz::get()->count();


        return view('dashboard',compact('category_count','admin_count','user_count','quiz_count'));
    }
}
