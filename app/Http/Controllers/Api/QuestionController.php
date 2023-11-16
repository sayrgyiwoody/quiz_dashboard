<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Quiz;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\PlayedHistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    //get question list with quiz id
    public function getQuestionList(Request $request){
        $quiz = Quiz::where('quiz_id',$request->quiz_id)->first();
        $question = Question::where('quiz_id',$request->quiz_id)->first();
        $question_list = unserialize($question->question_list);

        //also create play history with user id
        $this->addPlayedHistory($request->quiz_id);

        return response()->json(['status'=>'success','quiz'=>$quiz,'question_list'=>$question_list], 200);
    }

    private function addPlayedHistory($quiz_id){
        if(Auth::check()){
            $isExist = PlayedHistory::where('user_id',Auth::user()->id)->where('quiz_id',$quiz_id)->first();
            if($isExist){
                PlayedHistory::where('user_id',Auth::user()->id)->where('quiz_id',$quiz_id)->update([
                    'updated_at' => Carbon::now(),
                ]);
            }else {
                PlayedHistory::create([
                    'quiz_id' => $quiz_id,
                    'user_id' => Auth::user()->id,
                ]);
            }
            $played_count = Quiz::where('quiz_id',$quiz_id)->first();
            Quiz::where('quiz_id',$quiz_id)->update([
                'played_count' => $played_count->played_count + 1
            ]);
        }
    }

    // answer check for each question
    public function answerCheck(Request $request){
        $answer = Answer::where('quiz_id',$request->quiz_id)->first();
        $answer_list = unserialize($answer->answer_list);

        $quiz_answer = '';
        $answerStatus = null;

        foreach($answer_list as $a) {
            if($a['id'] == $request->question_id) {
                $quiz_answer = $a['answer'];
                break;
            }
        }
        if(strtolower($request->user_answer) === strtolower($quiz_answer)) {
            $answerStatus = true;
            return response()->json(['answerStatus'=>$answerStatus], 200,);
        }else {
            $answerStatus = false;
            return response()->json(['answerStatus'=>$answerStatus], 200,);
        }
    }

    // request answer
    public function answerRequest(Request $request){
        $answer = Answer::where('quiz_id',$request->quiz_id)->first();
        $answer_list = unserialize($answer->answer_list);

        $quiz_answer = null;

        foreach($answer_list as $a) {
            if($a['id'] == $request->question_id) {
                $quiz_answer = $a['answer'];
                break;
            }
        }
        return response()->json(['requestedAnswer' => $quiz_answer], 200);
    }
}
