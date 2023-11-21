<?php
// all external routes are put here

use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/student.php';
require __DIR__ . '/admin.php';

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
    return view('welcome');
})->name('welcome'); // I added an alias

// testing imagick installation
Route::get('/test/1', function () {
    if (extension_loaded('imagick')) {
        phpinfo();
    } else {
        return 'Imagick extension not installed.';
    }   
});

// google sso route
Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])
    ->name('google_redirect');
Route::get('/student/auth/google/callback', [GoogleAuthController::class, 'callback'])
    ->name('google_callback');

// other external routes
Route::get('/data-privacy', [Controller::class, 'showDataPrivacyPolicy'])
    ->name('data_privacy');
Route::get('/terms-conditions', [Controller::class, 'showTermsAndConditions'])
    ->name('terms_conditions');
