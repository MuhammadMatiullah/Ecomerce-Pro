<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\User\UserController;

Route::view('/', 'welcome');

Auth::routes();

// Admin route (use controller)
Route::get('/admin', [AdminController::class, 'index'])
    ->name('admin.dashboard');

// Custom login/register routes
Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm']);

Route::get('/login/writer', [LoginController::class, 'showWriterLoginForm']);
Route::get('/register/admin', [RegisterController::class, 'showAdminRegisterForm']);
Route::get('/register/writer', [RegisterController::class, 'showWriterRegisterForm']);


Route::post('/login/writer', [LoginController::class, 'writerLogin']);
Route::post('/login/admin', [LoginController::class, 'adminLogin']);

Route::post('/register/admin', [RegisterController::class, 'createAdmin']);
Route::post('/register/writer', [RegisterController::class, 'createWriter']);

// Normal user home
Route::view('/home', 'home')->middleware('auth');

// Writer dashboard
Route::view('/writer', 'writer')->middleware('auth');



// Users routes for admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', \App\Http\Controllers\Admin\User\UserController::class);
});


