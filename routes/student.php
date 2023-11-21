<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

// all student routes here
Route::group(['prefix' => 'student'], function () { // all routes here have /student/ prefix

    // Example route using the 'student' guard
    Route::middleware('auth:student')->group(function () {
        //-------------------------for view routing-------------------------
        // student dashboard
        Route::get('/', [StudentController::class, 'showIndex'])
            ->name('student_dashboard');
        // student profile
        Route::get('/profile/{student}', [StudentController::class, 'showProfile'])
            ->name('student_profile');

        //-------------------------for functionality routing-------------------------
        // processign of admin logout
        Route::post('/process-logout', [StudentController::class, 'processLogout'])
            ->name('student_processlogout');
        // qr code in profile
        Route::get('/qrcode/display', [StudentController::class, 'displayQRCode'])
            ->name('display_qr');
        Route::get('qrcode/generate/{student_osasid}', [StudentController::class, 'generateQR'])
            ->name('generate_qr');
    }); // end auth:student guard

    //-------------------------for view routing-------------------------
    // student login
    Route::get('/login', [StudentController::class, 'showLogin'])
        ->name('student_login');
    // student signup step1
    Route::get('/signup-step1', [StudentController::class, 'showSignup1'])
        ->name('student_signup1');

    //-------------------------for functionality routing-------------------------
    // for google single sign on
    Route::get('/auth/google/callback/', [GoogleAuthController::class, 'callback'])
        ->name('google_callback');
    // processing signup step 1, takes student_id parameter from view
    Route::post('/store-signup1/{student_id}', [StudentController::class, 'storeSignup1'])
        ->name('student_storeSignup1');
});
