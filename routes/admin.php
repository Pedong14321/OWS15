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
<<<<<<< HEAD
        // scholarship
        Route::get('/scholarships', [AdminController::class, 'Scholarship'])
            ->name('admin.scholarships');
        // showcreateScholarship
        Route::post('/savescholar', [AdminController::class, 'savescholar'])
            ->name('admin_savescholar_index');
        Route::post('/delete', [AdminController::class, 'delete'])
            ->name('admin.delete');
        Route::get('/admin/grantees', [AdminController::class, 'Grantees'])
            ->name('admin.grantees');
        Route::post('/admin/savesgrant', [AdminController::class, 'savesgrant'])
            ->name('admin.savesgrant');
        Route::post('/admin/EditGrants', [AdminController::class, 'EditGrants'])
            ->name('admin.EditGrants');
        Route::get('/admin/EditGrant', [AdminController::class, 'EditGrant'])
            ->name('admin.EditGrant');

=======
        Route::get('/events/scanner/{event_id}', [AdminController::class, 'showEventScanner'])
            ->name('admin_event_scanner');
        Route::get('/events/{event_id}', [AdminController::class, 'showEventDetails'])
            ->name('admin_event_details');

        //---------------scholarship---------------

        Route::get('/scholarship', [AdminController::class, 'showScholarshipIndex'])
            ->name('admin_scholarship');
        Route::get('/scholarship/create', [AdminController::class, 'showCreateScholarship'])
            ->name('admin_create_scholarship');
        Route::get('/scholarship/{id}', [AdminController::class, 'showScholarshipDetails'])
            ->name('admin_scholarship_details');
        Route::get('/scholarship/{id}/edit', [AdminController::class, 'showScholarshipEdit'])
            ->name('admin_scholarship_editpage');
        Route::get('/scholarship/archived', [AdminController::class, 'showArchivedScholarship'])
            ->name('admin_archived_scholarships');
        Route::get('/scholarship/{id}/grantees', [AdminController::class, 'showScholarshipGrantees'])
            ->name('admin_scholarship_grantees');
>>>>>>> upstream/main

        //-------------------------for functionality routing-------------------------

        Route::post('/create-store', [AdminController::class, 'storeCreate'])
            ->name('admin_store_create');
        Route::post('/process-logout', [AdminController::class, 'processLogout'])
            ->name('admin_processlogout');
        Route::get('/qr-scanner/result', [AdminController::class, 'processQR'])
            ->name('admin_procesqr');
        Route::post('/event/store', [AdminController::class, 'storeEvent'])
            ->name('admin_store_event');
        Route::post('/qr-scanner/result/confirm', [AdminController::class, 'storeAttendance'])
            ->name('admin_confirm_attdc');
        Route::post('/scholarshsip/create/store', [AdminController::class, 'storeScholarship'])
            ->name('admin_store_scholarship');
        Route::post('/scholarship/{id}/update', [AdminController::class, 'updateScholarship'])
            ->name('admin_update_scholarship');
        Route::get('/scholarship/{id}/archive', [AdminController::class, 'archiveScholarship'])
            ->name('admin_archive_scholarship');
        Route::get('/scholarship/{id}/archive/restore', [AdminController::class, 'restoreScholarship'])
            ->name('admin_restore_scholarship');
            
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
