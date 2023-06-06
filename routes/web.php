<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\auth\VerifyAccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\MyAccountController;
use App\Http\Controllers\PostController;
use App\Models\Otp;
use App\Models\Token;
use App\Models\User;
use App\Notifications\OtpWithEmail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/* Route::group(['prefix' => 'api','as' => 'api.'],function () {
    Route::group(['prefix' => 'auth','as' => 'auth.'],function () {
        Route::post('login', [AuthController::class, 'loginWithPass'])->name('loginWithPass');
    
    
    });


});
 */





Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::get('login', [AuthController::class, 'index'])->name('index')->middleware(['guest']);
    Route::post('login', [AuthController::class, 'loginWithPass'])->name('loginWithPass')->middleware(['guest']);
    Route::get('logout', [AuthController::class, 'logout'])->name('logout')->middleware(['auth']);
    Route::post('register', [AuthController::class, 'register'])->name('register')->middleware(['guest']);
    Route::post('lostPassword', [AuthController::class, 'lostPassword'])->name('lostPassword')->middleware(['guest']);
    Route::get('verifyAccount ', [VerifyAccountController::class, 'index'])->name('verifyaccount')->middleware(['auth']);
    Route::post('sendOtp', [VerifyAccountController::class, 'sendOtp'])->name('sendOtp')->middleware(['auth']);
    Route::post('validateOtp', [VerifyAccountController::class, 'validateOtp'])->name('validateOtp')->middleware(['auth']);

    Route::get('/', function () {return to_route('auth.index');});
    Route::fallback(function () {return to_route('auth.index');});
});



Route::group(['prefix' => 'my', 'as' => 'my.','middleware'=>'auth'], function () {
    Route::get('/', [MyAccountController::class, 'index'])->name('index');

});


Route::group(['prefix' => 'manage', 'as' => 'manage.','middleware'=>'auth'], function () {
    Route::get('/', [ManagementController::class, 'index'])->name('index');
    Route::resource('posts',PostController::class);

});


Route::get('/', function () {
   return view('welcome');
});
