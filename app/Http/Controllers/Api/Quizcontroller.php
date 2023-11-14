<?php

namespace App\Http\Controllers\Api;

use App\Models\Quiz;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Question;
use App\Models\SavedQuiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Quizcontroller extends Controller
{

    public function getCategory(){
        $categories = Category::orderBy('created_at','desc')->get();
        return response()->json(['categories'=>$categories], 200);
    }

    public function getCategoryWithCount(){

        $categories = Category::withCount('quizzes')->get();
        return response()->json(['categories'=>$categories], 200);
    }

    public function create(Request $request){
        $user_id = Auth::user()->id;
        $total_count = count($request->question_list);
        $quiz = Quiz::create([
            'user_id' => $user_id,
            'category_id' =>$request->category_id,
            'title' => $request->quiz_title,
            'desc' => $request->quiz_desc,
            'total_count' => $total_count,
        ]);
        $question_list = serialize($request->question_list);
        $answer_list = serialize($request->answer_list);
        Question::create([
            'quiz_id' => $quiz->id,
            'question_list' => $question_list,
        ]);
        Answer::create([
            'quiz_id' => $quiz->id,
            'answer_list' => $answer_list,
        ]);
        return response()->json(['status' => 'true'], 200);
    }

    // update quiz
    public function update(Request $request){

        $user_id = Auth::user()->id;
        $total_count = count($request->question_list);
        $quiz = Quiz::where('quiz_id',$request->edit_quiz_id)->update([
            'user_id' => $user_id,
            'category_id' =>$request->category_id,
            'title' => $request->quiz_title,
            'desc' => $request->quiz_desc,
            'total_count' => $total_count,
        ]);
        $question_list = serialize($request->question_list);
        $answer_list = serialize($request->answer_list);
        Question::where('quiz_id',$request->edit_quiz_id)->update([
            'quiz_id' => $request->edit_quiz_id,
            'question_list' => $question_list,
        ]);
        Answer::where('quiz_id',$request->edit_quiz_id)->update([
            'quiz_id' => $request->edit_quiz_id,
            'answer_list' => $answer_list,
        ]);
        return response()->json(['status' => 'true'], 200);
    }

    public function getLatestQuizzes(){
        $latest_quizzes = Quiz::select('quizzes.*','users.name as user_name','categories.name as category_name')
        ->leftJoin('users','quizzes.user_id','users.id')
        ->leftJoin('categories','quizzes.category_id','categories.id')
        ->orderBy('quizzes.created_at','desc')->take(8)->get();
        foreach ($latest_quizzes as $quiz) {
            $savedQuiz = SavedQuiz::where('user_id', Auth::user()->id)
                ->where('quiz_id', $quiz->quiz_id)
                ->first();

            $quiz->saved = $savedQuiz ? true : false;
        }

        return response()->json(['status' => true , 'latest_quizzes' => $latest_quizzes], 200);
    }

    public function getAllQuizzes(Request $request){
        $all_quizzes = Quiz::select('quizzes.*','users.name as user_name','categories.name as category_name')
        ->leftJoin('users','quizzes.user_id','users.id')
        ->leftJoin('categories','quizzes.category_id','categories.id')
        ->where('quizzes.title','like','%'.request('searchKey').'%')
        ->orWhere('quizzes.desc','like','%'.request('searchKey').'%')
        ->orWhere('categories.name','like','%'.request('searchKey').'%')
        ->orderBy('quizzes.created_at','desc')->paginate(9);

        foreach ($all_quizzes as $quiz) {
            $savedQuiz = SavedQuiz::where('user_id', Auth::user()->id)
                ->where('quiz_id', $quiz->quiz_id)
                ->first();

            $quiz->saved = $savedQuiz ? true : false;
        }


        return response()->json(['status'=>true,'all_quizzes'=>$all_quizzes], 200);
    }

    public function categoryFilter(Request $request){
        $all_quizzes = Quiz::select('quizzes.*','users.name as user_name','categories.name as category_name')
        ->leftJoin('users','quizzes.user_id','users.id')
        ->leftJoin('categories','quizzes.category_id','categories.id')
        ->orderBy('quizzes.created_at','desc')
        ->where('category_id',$request->category_id)
        ->where(function ($query) use ($request) {
            $query->where('quizzes.title', 'like', '%' . $request->searchKey . '%')
                  ->orWhere('quizzes.desc', 'like', '%' . $request->searchKey . '%');
        })
        ->paginate(9);

        foreach ($all_quizzes as $quiz) {
            $savedQuiz = SavedQuiz::where('user_id', Auth::user()->id)
                ->where('quiz_id', $quiz->quiz_id)
                ->first();

            $quiz->saved = $savedQuiz ? true : false;
        }

        return response()->json(['status'=>true,'all_quizzes'=>$all_quizzes], 200);
    }

    public function getDetail(Request $request){
        $quiz = Quiz::select('quizzes.*','users.name as user_name','categories.name as category_name')
        ->leftJoin('users','quizzes.user_id','users.id')
        ->leftJoin('categories','quizzes.category_id','categories.id')
        ->orderBy('quizzes.created_at','desc')
        ->where('quiz_id',$request->quiz_id)
        ->first();

        return response()->json(['status'=>true,'quiz'=>$quiz], 200);
    }

    public function searchQuizzes(Request $request){
        $searched_quizzes = Quiz::select('quizzes.*','users.name as user_name','categories.name as category_name')
        ->leftJoin('users','quizzes.user_id','users.id')
        ->leftJoin('categories','quizzes.category_id','categories.id')
        ->orderBy('created_at','desc')
        ->where('quizzes.title','like','%'.request('searchKey').'%')
        ->orWhere('quizzes.desc','like','%'.request('searchKey').'%')
        ->paginate(9);
        foreach ($searched_quizzes as $quiz) {
            $savedQuiz = SavedQuiz::where('user_id', Auth::user()->id)
                ->where('quiz_id', $quiz->quiz_id)
                ->first();

            $quiz->saved = $savedQuiz ? true : false;
        }
        return response()->json(['status'=>true,'searched_quizzes'=>$searched_quizzes], 200);
    }

    public function deleteQuiz(Request $request){
        Quiz::where('quiz_id',$request->quiz_id)->delete();
        SavedQuiz::where('quiz_id',$request->quiz_id)->delete();
        return response()->json(['status'=>'deleted','icon'=>'success','message'=>'quiz deleted successfully.'], 200);

    }

    public function getEditInfo(Request $request){
        $quiz = Quiz::where('quiz_id',$request->quiz_id)->first();
        $question = Question::where('quiz_id',$request->quiz_id)->first();
        $question_list = unserialize($question->question_list);
        $answer = Answer::where('quiz_id',$request->quiz_id)->first();
        $answer_list = unserialize($answer->answer_list);
        $categories = Category::orderBy('created_at','desc')->get();
        return response()->json([
            'status'=>true,
            'quiz'=>$quiz,
            'question_list'=>$question_list,
            'answer_list'=>$answer_list,
            'categories' => $categories,
        ], 200);
    }

}
