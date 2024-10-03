<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UserController;
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


Route::group(['middleware' => ['auth', \App\Http\Middleware\UserStatusCheck::class]], function () {

    Route::group(['middleware' => 'admin', 'prefix'=>'admin'], function () {
        Route::group(['controller'=>\App\Http\Controllers\AdminController::class], function () {
            Route::get('/', 'index')->name('admin-index');
            Route::get('user-management', 'userManagerIndex')->name('user-management');
            Route::put('user-management/{user}', 'userManagementUpdate')->name('user.update');
            Route::post('user-management/create', 'createUser')->name('user.create');
        });
        Route::resource('groups', \App\Http\Controllers\UserGroupController::class);
        Route::post('pages/reorder', [\App\Http\Controllers\PageController::class, 'reorder'])->name('pages.updateSort');
        Route::post('pages/{page}/status/change', [\App\Http\Controllers\PageController::class, 'toggleStatus'])->name('pages.toggleStatus');

    });

    Route::group(['controller'=> UserController::class], function () {
        Route::get('dashboard', 'dashboard')->name('dashboard');
        Route::get('user-profile', 'create')->name('get-user-profile');
        Route::post('user-profile', 'store')->name('update-user-profile');
        Route::get('billing', 'showBilling')->name('billing');
        Route::put('/user/{user}/update-image', 'updateImage')->name('user.update.image');
    });

    Route::resource('books', \App\Http\Controllers\BookController::class);
    Route::resource('pages', \App\Http\Controllers\PageController::class);




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
