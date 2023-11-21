<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

// all admin routes here
Route::group(['prefix' => 'admin'], function () { // all routes here have /admin/ prefix

    // only accessible after login
    Route::group(['middleware' => 'admin_auth'], function () {
        //-------------------------for views routing-------------------------
        // dashboard
        Route::get('/', [AdminController::class, 'showIndex'])
            ->name('admin_dashboard');
        // manage admins 
        Route::get('/manage', [AdminController::class, 'showAdminManage'])
            ->name('admin_manage');
        // admin profile
        Route::get('/profile/{admin}', [AdminController::class, 'showProfile'])
            ->name('admin_profile');
        // create admin
        Route::get('/create', [AdminController::class, 'showCreateAdmin'])
            ->name('admin_create');
        // office 
        Route::get('/offices', [AdminController::class, 'showOfficeIndex'])
            ->name('admin_offices');
        // qr scanner 
        Route::get('/qr-scanner', [AdminController::class, 'showQRscanner'])
            ->name('admin_qrscanner');
        // student event
        Route::get('/events', [AdminController::class, 'showStudentEvents'])
            ->name('admin_stud_events');
        // showCreateEvents
        Route::get('/events/create', [AdminController::class, 'showCreateEvents'])
            ->name('admin_create_event');

        //-------------------------for functionality routing-------------------------
        // creating new admin
        Route::post('/create-store', [AdminController::class, 'storeCreate'])
            ->name('admin_store_create');
        // processign of admin logout
        Route::post('/process-logout', [AdminController::class, 'processLogout'])
            ->name('admin_processlogout');
        // qr scan result
        Route::post('/qr-scanner/result', [AdminController::class, 'processQR'])
            ->name('admin_procesqr');
        // storeEvent
        Route::post('/event/store', [AdminController::class, 'storeEvent'])
            ->name('admin_store_event');
    }); //end of auth:admin middleware

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


    //-------------------------for functionality routing-------------------------
    // admin_signup1store
    Route::post('/signup1-store', [AdminController::class, 'storeSignup1'])
        ->name('admin_signup1store');
    // admin_signup2store
    Route::post('/signup2-store', [AdminController::class, 'storeSignup2'])
        ->name('admin_signup2store');
    // processing of admin login
    Route::post('/process-login', [AdminController::class, 'processLogin'])
        ->name('admin_processlogin');
});
