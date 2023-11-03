<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function setting () {
        return view('setting.index');
    }

    public function profile () {
        return view('setting.profile');
    }
}
