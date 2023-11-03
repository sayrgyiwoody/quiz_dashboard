<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::user()->role==='admin'){
            return redirect()->route('admin.home');
        }else if(Auth::user()->role==='user'){
            return redirect()->route('user.home');
        }
    }
}
