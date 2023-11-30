<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

// all admin routes here
Route::group(['prefix' => 'admin'], function () { // all routes here have /admin/ prefix

    // only accessible after login
    Route::group(['middleware' => 'admin_auth'], function () {

        //-------------------------for views routing-------------------------

        //---------------dashboard---------------
        Route::get('/', [AdminController::class, 'showIndex'])
            ->name('admin_dashboard');
        Route::get('/manage', [AdminController::class, 'showAdminManage'])
            ->name('admin_manage');
        Route::get('/profile/{admin}', [AdminController::class, 'showProfile'])
            ->name('admin_profile');
        Route::get('/create', [AdminController::class, 'showCreateAdmin'])
            ->name('admin_create');

        //---------------offices---------------
        Route::get('/offices', [AdminController::class, 'showOfficeIndex'])
            ->name('admin_offices');

        //---------------clearance---------------
        Route::get('/clearance', [AdminController::class, 'showClearanceIndex'])
            ->name('admin_clearance');

        //---------------events---------------
        Route::get('/events', [AdminController::class, 'showEventsIndex'])
            ->name('admin_stud_events');
        Route::get('/events/create', [AdminController::class, 'showCreateEvents'])
            ->name('admin_create_event');

        //---------------events---------------
        Route::get('/attendance', [AdminController::class, 'showAttendanceIndex'])
            ->name('admin_attendance');

        //---------------scholarship---------------

        Route::get('/scholarship', [AdminController::class, 'showScholarshipIndex'])
            ->name('admin_scholarship');

        //-------------------------for functionality routing-------------------------

        Route::post('/create-store', [AdminController::class, 'storeCreate'])
            ->name('admin_store_create');
        Route::post('/process-logout', [AdminController::class, 'processLogout'])
            ->name('admin_processlogout');
        Route::post('/qr-scanner/result', [AdminController::class, 'processQR'])
            ->name('admin_procesqr');
        Route::post('/event/store', [AdminController::class, 'storeEvent'])
            ->name('admin_store_event');
        Route::post('/events/scanner', [AdminController::class, 'showEventScanner'])
            ->name('admin_event_scanner');
        Route::post('/events/attendance', [AdminController::class, 'showEventAttendace'])
            ->name('admin_event_attdc');
        Route::post('/qr-scanner/result/confirm', [AdminController::class, 'storeAttendance'])
            ->name('admin_confirm_attdc');
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
