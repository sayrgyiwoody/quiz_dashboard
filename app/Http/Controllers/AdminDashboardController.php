<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function dashboard () {
        $category_count = Category::get()->count();
        $admin_count = User::where('role','admin')->get()->count();
        $user_count = User::where('role','user')->get()->count();
        $quiz_count = Quiz::get()->count();
        $endDate = now(); // Current date and time
        $startDate = now()->subDays(29); // 30 days ago

    $userCounts = User::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
        ->whereBetween('created_at', [$startDate, $endDate])
        ->groupBy('date')
        ->orderBy('date')
        ->pluck('count');

        $userCountsBeforeStart = User::where('created_at', '<', $startDate)->count();

        $dates = User::select(
            DB::raw('DATE(created_at) as date')
        )
        ->whereBetween('created_at', [$startDate, $endDate])
        ->groupBy('date')
        ->orderBy('date')
        ->pluck('date');

        $categories_chart = Quiz::select('categories.name', DB::raw('COUNT(*) as count'))
        ->leftJoin('categories','quizzes.category_id','categories.id')
        ->groupBy('categories.name')
        ->get();



        $most_played_quizzes = Quiz::select('quizzes.*','categories.name as category_name')
        ->leftJoin('categories','quizzes.category_id','categories.id')
        ->orderBy('played_count','desc')->take(5)->get();

        return view('dashboard',compact('category_count','admin_count','user_count','quiz_count','most_played_quizzes','userCounts','dates','userCountsBeforeStart','categories_chart'));
    }
}
