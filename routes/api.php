<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\QuizController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\SaveQuizController;
use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\Api\UserAccountController;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\RoomController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// login account
Route::post('/login',[AuthController::class,'login']);
Route::post('/register',[AuthController::class,'register']);
Route::post('/requestPassword',[ForgotPasswordController::class,'requestPassword']);



Route::group(['prefix'=>'account','middleware'=>'auth:sanctum'],function(){
    // get personal information
    Route::get('/getProfileInfo',[UserAccountController::class,'getProfileInfo']);
    Route::post('/updateProfileInfo',[UserAccountController::class,'updateProfileInfo']);
    Route::post('/isOldPassword',[UserAccountController::class,'isOldPassword']);
    Route::post('/changePassword',[UserAccountController::class,'changePassword']);
    Route::post('/deleteAccount',[UserAccountController::class,'deleteAccount']);


});


Route::group(['prefix'=>'category','middleware'=>'auth:sanctum'],function(){
    Route::get('/list',[QuizController::class,'getCategory']);

    Route::get('/listWithCount',[QuizController::class,'getCategoryWithCount']);

});


Route::group(['prefix'=>'quiz','middleware'=>'auth:sanctum'],function(){
    //create quiz
    Route::post('/create',[QuizController::class,'create']);

    // update quiz
    Route::post('/update',[QuizController::class,'update']);

    Route::get('/getHomeQuizzes',[QuizController::class,'getHomeQuizzes']);

    Route::post('/all',[QuizController::class,'getAllQuizzes']);

    Route::post('/categoryFilter',[QuizController::class,'categoryFilter']);

    Route::post('/detail',[QuizController::class,'getDetail']);

    Route::post('/search',[QuizController::class,'searchQuizzes']);


    // save quiz
    Route::post('/saveQuiz',[SaveQuizController::class,'saveQuiz']);

    // delete quiz
    Route::post('/deleteQuiz',[QuizController::class,'deleteQuiz']);

    // delete all history of user
    Route::post('/deleteAllHistory',[QuizController::class,'deleteAllHistory']);

    // get edit information
    Route::post('/getEditInfo',[QuizController::class,'getEditInfo']);


    Route::post('/getPaginatedSaved',[SaveQuizController::class,'getPaginatedSaved']);

    Route::post('/getRecentQuizzes',[SaveQuizController::class,'getRecentQuizzes']);


    Route::post('/getCreatedQuizzes',[SaveQuizController::class,'getCreatedQuizzes']);

});

Route::group(['prefix'=>'multiplayer','middleware'=>'auth:sanctum'],function(){
    Route::post('/generateRoom',[RoomController::class,'generateRoom']);
    Route::post('/joinRoom',[RoomController::class,'joinRoom']);
    Route::post('/getRoomInfo',[RoomController::class,'getRoomInfo']);
    Route::post('/endRoom',[RoomController::class,'endRoom']);

});

//get question list with id
Route::post('/getQuestionList',[QuestionController::class,'getQuestionList'])->middleware('auth:sanctum');

// answer check for each question
Route::post('/answerCheck',[QuestionController::class,'answerCheck'])->middleware('auth:sanctum');

// request answer
Route::post('/answerRequest',[QuestionController::class,'answerRequest'])->middleware('auth:sanctum');


Route::get('/auth/{provider}/callback',[ProviderController::class,'callback']);
