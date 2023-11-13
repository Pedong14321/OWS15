<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

// test route only
Route::get('/test', [AdminController::class, 'showTest'])
    ->name('test');

// all admin routes here
Route::group(['prefix' => 'admin'], function () { // all routes here have /admin/ prefix

    //-------------------------for views routing-------------------------

    // signup first step
    Route::get('/signup', [AdminController::class, 'showSignup1'])
        ->name('admin_signup1');
    // signup second step
    Route::get('/signup-step2', [AdminController::class, 'showSignup2'])
        ->name('admin_signup2');
    // admin login
    Route::get('/login', [AdminController::class, 'showLogin'])
        ->name('admin_login');
    // dashboard
    Route::get('/', [AdminController::class, 'showIndex'])
        ->name('admin_dashboard');
    // manage admins 
    Route::get('/manage', [AdminController::class, 'showAdminManage'])
        ->name('admin_manage');
    // office 
    Route::get('/offices', [AdminController::class, 'showOfficeIndex'])
        ->name('admin_offices');

    //-------------------------for functionality routing-------------------------

    // admin_signup1store
    Route::post('/signup1-store', [AdminController::class, 'storeSignup1'])
        ->name('admin_signup1store');

    // admin_signup2store
    Route::post('/signup2-store', [AdminController::class, 'storeSignup2'])
        ->name('admin_signup2store');

    // processign of admin login
    Route::post('/process-login', [AdminController::class, 'processLogin'])
        ->name('admin_processlogin');

    // processign of admin logout
    Route::post('/process-logout', [AdminController::class, 'processLogout'])
        ->name('admin_processlogout');
});
