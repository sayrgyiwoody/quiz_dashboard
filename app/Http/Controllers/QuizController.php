<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Models\PlayedHistory;
use App\Http\Controllers\Controller;

class QuizController extends Controller
{
    // show quiz list to admin
    public function list(){
        $quizzes = Quiz::select('quizzes.*','users.name as user_name','users.profile_photo_path as user_image','categories.name as category_name')
        ->leftJoin('users','quizzes.user_id','users.id')
        ->leftJoin('categories','quizzes.category_id','categories.id')

        ->when(request('searchKey'),function($query){

            $query->where('quizzes.title','like','%'.request('searchKey').'%')
            ->orWhere('quizzes.desc','like','%'.request('searchKey').'%');
        });

        if(request('filterStatus') == "ascending"){
            $quizzes = $quizzes->orderBy('quizzes.created_at','asc')->paginate(10);
        }else  if(request('filterStatus') == "AZ"){
            $quizzes = $quizzes->orderBy('quizzes.title','asc')->paginate(10);
        }else  if(request('filterStatus') == "MostPlayed"){
            $quizzes = $quizzes->orderBy('quizzes.played_count','desc')->paginate(10);
        }else {
            $quizzes = $quizzes->orderBy('quizzes.created_at','desc')->paginate(10);
        }

        return view('quiz.index',compact('quizzes'));

    }

    public function delete(Request $request) {
        Quiz::where('quiz_id',$request->id)->delete();
        return back()->with(['alert'=>'Category deleted successfully.']);
    }

    public function getDetail($quiz_id){
        $quiz = Quiz::select('quizzes.*','users.name as user_name','users.profile_photo_path as user_image','categories.name as category_name')
        ->leftJoin('users','quizzes.user_id','users.id')
        ->leftJoin('categories','quizzes.category_id','categories.id')
        ->orderBy('quizzes.created_at','desc')
        ->where('quiz_id',$quiz_id)
        ->first();

        $played_count = PlayedHistory::where('quiz_id',$quiz_id)->count();
        
        return view('quiz.detail',compact('quiz','played_count'));
    }
}
