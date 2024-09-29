<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
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


Route::group(['middleware' => 'auth'], function () {

    Route::group(['middleware' => 'admin', 'prefix'=>'admin', 'controller'=>\App\Http\Controllers\AdminController::class], function () {
        Route::get('/', 'index')->name('admin-index');
        Route::get('user-management', 'userManagerIndex')->name('user-management');
    });

    Route::group(['controller'=>\App\Http\Controllers\UserController::class], function () {
        Route::get('dashboard', 'dashboard')->name('dashboard');
        Route::get('user-profile', [InfoUserController::class, 'create']);
        Route::post('user-profile', [InfoUserController::class, 'store']);
        Route::get('billing', 'showBilling')->name('billing');
    });

    Route::resource('books', \App\Http\Controllers\BookController::class);

    Route::get('/', [HomeController::class, 'home']);





	Route::get('profile', function () {
		return view('profile');
	})->name('profile');




	Route::get('tables', function () {
		return view('tables');
	})->name('tables');


    Route::get('/logout', [SessionsController::class, 'destroy']);

    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
});



Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
    Route::get('404', function () {
        return view('404');
    })->name('404');

});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');
