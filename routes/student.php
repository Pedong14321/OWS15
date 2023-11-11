<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

    // all student routes here
Route::group(['prefix' => 'student'], function () {
    Route::get('/', [StudentController::class, 'showIndex'])
        ->name('student_home');
    Route::get('/login', [StudentController::class, 'showLogin'])
        ->name('student_showlogin');
    Route::get('/signup-step1', [StudentController::class, 'showSignup1'])
        ->name('student_signup1');
    // for google single sign on
    Route::get('/auth/google/callback/', [GoogleAuthController::class, 'callback'])
        ->name('google_callback');
});