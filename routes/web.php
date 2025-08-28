<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\FrontendController;
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
  // Show all users
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    // Show create form
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    // Store user
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    // Show edit form
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    // Update user
    Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');
    // Delete user
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});


// frontend 
Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
