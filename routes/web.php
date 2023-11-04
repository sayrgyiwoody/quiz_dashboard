<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminAccountController;
use App\Http\Controllers\AdminSettingController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::get('/register',function(){
    return redirect()->back();
});

Route::post('password/forgot',[ForgotPasswordController::class,'sendResetLink'])->name('forgot.password.link');
Route::get('password/reset/{token}',[ForgotPasswordController::class,'showResetForm'])->name('reset.password.form');
Route::post('password/reset',[ForgotPasswordController::class,'resetPassword'])->name('reset.password');



Route::middleware(['auth'])->group(function () {

    Route::group(['prefix'=>'admin','middleware'=>['admin_auth']],function(){
        Route::get('/dashboard',[AdminDashboardController::class,'dashboard'])->name('admin.dashboard');

        Route::group(['prefix'=>'setting'],function(){
            Route::get('/',[AdminSettingController::class,'setting'])->name('admin.setting');
            Route::get('/profile',[AdminSettingController::class,'profile'])->name('admin.setting.profile');
            Route::post('/profile/update',[AdminAccountController::class,'updateAccount'])->name('admin.update.account');
            Route::get('/security',[AdminSettingController::class,'security'])->name('admin.setting.security');
            Route::post('/security/changePassword',[AdminAccountController::class,'changePassword'])->name('admin.update.password');
            Route::post('/security/deleteAccount',[AdminAccountController::class,'deleteAccount'])->name('admin.delete.account');
            Route::get('/password/forgot',[ForgotPasswordController::class,'passwordRequestPage'])->name('admin.password.request');
        });

        Route::group(['prefix'=>'category'],function(){
            Route::get('/',[CategoryController::class,'list'])->name('category.list');
            Route::post('create',[CategoryController::class,'create'])->name('category.create');
            Route::post('delete',[CategoryController::class,'delete'])->name('category.delete');


        });


    });

    Route::group(['prefix'=>'user','middleware'=>['user_auth']],function(){
        Route::get('/home',function(){
            return view('welcome');
        })->name('user.home');

    });

});

