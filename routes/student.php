<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

// all student routes here
Route::group(['prefix' => 'student'], function () { // all routes here have /student/ prefix

    // student dashboard
    Route::get('/', [StudentController::class, 'showIndex'])
        ->name('student_dashboard');
    // student login
    Route::get('/login', [StudentController::class, 'showLogin'])
        ->name('student_login');
    // student signup step1
    Route::get('/signup-step1', [StudentController::class, 'showSignup1'])
        ->name('student_signup1');
    // admin profile
    Route::get('/profile/{student}', [StudentController::class, 'showProfile'])
        ->name('student_profile');

    //-------------------------for functionality routing-------------------------


    // for google single sign on
    Route::get('/auth/google/callback/', [GoogleAuthController::class, 'callback'])
        ->name('google_callback');

    // processign of admin logout
    Route::post('/process-logout', [StudentController::class, 'processLogout'])
        ->name('student_processlogout');
});
