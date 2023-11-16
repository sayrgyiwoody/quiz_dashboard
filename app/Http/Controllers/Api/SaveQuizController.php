<?php

namespace App\Http\Controllers\Api;

use App\Models\Quiz;
use App\Models\SavedQuiz;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PlayedHistory;
use Illuminate\Support\Facades\Auth;

class SaveQuizController extends Controller
{
    public function saveQuiz(Request $request){
        $isExist = SavedQuiz::where('user_id',Auth::user()->id)->where('quiz_id',$request->quiz_id)->first();
        if($isExist){
            SavedQuiz::where('user_id',Auth::user()->id)->where('quiz_id',$request->quiz_id)->delete();
            return response()->json(['status'=>'unsaved','icon'=>'info','message'=>'quiz unsaved'], 200);
        }else {
            SavedQuiz::create([
                'user_id' => Auth::user()->id,
                'quiz_id' => $request->quiz_id,
            ]);
            return response()->json(['status'=>'saved','icon'=>'success','message'=>'quiz saved successfully.'], 200);
        }
    }


    public function getPaginatedSaved(Request $request){

        $saved_quizzes = SavedQuiz::
        select('quizzes.*','users.name as user_name','categories.name as category_name')
        ->leftJoin('quizzes','saved_quizzes.quiz_id','quizzes.quiz_id')
        ->leftJoin('users','quizzes.user_id','users.id')
        ->leftJoin('categories','quizzes.category_id','categories.id')
        ->orderBy('saved_quizzes.created_at','desc')
        ->where('saved_quizzes.user_id',Auth::user()->id)
        ->where(function ($query) use ($request) {
            $query->where('quizzes.title', 'like', '%' . $request->searchKey . '%')
                  ->orWhere('quizzes.desc', 'like', '%' . $request->searchKey . '%')
                  ->orWhere('categories.name','like','%'. $request->searchKey . '%');
        })
        ->paginate(9);

        foreach ($saved_quizzes as $quiz) {
            $savedQuiz = SavedQuiz::where('user_id', Auth::user()->id)
                ->where('quiz_id', $quiz->quiz_id)
                ->first();

            $quiz->saved = $savedQuiz ? true : false;
        }
        return response()->json(['status'=>true,'saved_quizzes'=>$saved_quizzes], 200);

    }

    public function getRecentQuizzes(Request $request){

        $recent_quizzes = PlayedHistory::
        select('played_histories.*','played_histories.updated_at as latest_played','quizzes.*','users.name as user_name','categories.name as category_name')
        ->leftJoin('quizzes','played_histories.quiz_id','quizzes.quiz_id')
        ->leftJoin('users','quizzes.user_id','users.id')
        ->leftJoin('categories','quizzes.category_id','categories.id')
        ->orderBy('played_histories.updated_at','desc')
        ->where('played_histories.user_id',Auth::user()->id)
        ->where(function ($query) use ($request) {
            $query->where('quizzes.title', 'like', '%' . $request->searchKey . '%')
                  ->orWhere('quizzes.desc', 'like', '%' . $request->searchKey . '%')
                  ->orWhere('categories.name','like','%'. $request->searchKey . '%');
        })
        ->paginate(9);

        foreach ($recent_quizzes as $quiz) {
            $savedQuiz = SavedQuiz::where('user_id', Auth::user()->id)
                ->where('quiz_id', $quiz->quiz_id)
                ->first();

            $quiz->saved = $savedQuiz ? true : false;
        }
        return response()->json(['status'=>true,'recent_quizzes'=>$recent_quizzes], 200);

    }

    public function getCreatedQuizzes(Request $request){
        $created_quizzes = Quiz::select('quizzes.*','users.name as user_name','categories.name as category_name')
        ->leftJoin('users','quizzes.user_id','users.id')
        ->leftJoin('categories','quizzes.category_id','categories.id')
        ->orderBy('quizzes.created_at','desc')
        ->where('quizzes.user_id',Auth::user()->id)
        ->where(function ($query) use ($request) {
            $query->where('quizzes.title', 'like', '%' . $request->searchKey . '%')
                  ->orWhere('quizzes.desc', 'like', '%' . $request->searchKey . '%')
                  ->orWhere('categories.name','like','%'. $request->searchKey . '%');
        })

        ->paginate(9);

        foreach ($created_quizzes as $quiz) {
            $savedQuiz = SavedQuiz::where('user_id', Auth::user()->id)
                ->where('quiz_id', $quiz->quiz_id)
                ->first();

            $quiz->saved = $savedQuiz ? true : false;
        }
        logger(Auth::user()->id);
        logger($created_quizzes);

        return response()->json(['status'=>true,'created_quizzes'=>$created_quizzes], 200);

    }
}
