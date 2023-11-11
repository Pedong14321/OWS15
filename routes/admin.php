<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

// test route only
Route::get('/test', [AdminController::class, 'showTest'])
    ->name('test');

// all admin routes here
Route::group(['prefix' => 'admin'], function () { // all routes here have /admin/ prefix

    //-------------------------for routing views-------------------------

    // signup first step
    Route::get('/signup', [AdminController::class, 'showSignup1'])
        ->name('admin_signup1');
    // signup second step
    Route::get('/signup-step2', [AdminController::class, 'showSignup2'])
        ->name('admin_signup2');
    // admin login
    Route::get('/login', [AdminController::class, 'showLogin'])
        ->name('admin_login');

    //-------------------------for routing functionality-------------------------

    // admin_signup1store
    Route::post('/signup1-store', [AdminController::class, 'storeSignup1'])
        ->name('admin_signup1store');

    // admin_signup2store
    Route::post('/signup2-store', [AdminController::class, 'storeSignup2'])
        ->name('admin_signup2store');
});
