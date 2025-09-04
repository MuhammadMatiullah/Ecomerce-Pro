<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\Admin\ProductController;
Route::view('/', 'welcome');


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





// Show all categories (list)
Route::get('/admin/category', [CategoryController::class, 'category'])->name('category');
// Show create form
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
// Save category (POST)
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
// Show edit form
Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
// Update category (PUT/PATCH)
Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
// Delete
Route::delete('admin/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');



// Sub-Category routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('subcategory', [SubCategoryController::class, 'index'])->name('subcategory.index');
    // Show create form
    Route::get('subcategory/create', [SubCategoryController::class, 'create'])->name('subcategory.create');
    Route::post('subcategory/store', [SubCategoryController::class, 'store'])->name('subcategory.store');
    Route::get('/check-slug', [SubcategoryController::class, 'checkSlug'])->name('check.slug');
    // New Edit & Update routes
    Route::get('subcategory/{id}/edit', [SubCategoryController::class, 'edit'])->name('subcategory.edit');
    Route::post('subcategory/{id}/update', [SubCategoryController::class, 'update'])->name('subcategory.update');
    // Delete subcategory
    Route::delete('admin/subcategory/{id}', [SubCategoryController::class, 'destroy'])->name('subcategory.destroy');
});

//PRODUCT

Route::get('admin/product', [ProductController::class, 'index'])->name('admin.product.index');
Route::get('admin/product/create', [ProductController::class, 'create'])->name('admin.product.create');
Route::post('admin/product/store', [ProductController::class, 'store'])->name('admin.product.store');
 Route::get('admin/check-slug/product', [ProductController::class, 'checkSlug'])->name('check.slug.product');
 Route::get('admin/product/get-subcategories/{category_id}', [ProductController::class, 'getSubcategories'])->name('admin.product.get.subcategories');
// 👇 Edit + Update routes
Route::get('admin/product/{id}/edit', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('admin.product.edit');
Route::post('admin/product/{id}/update', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('admin.product.update');
// frontend 
Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
Route::get('/wishlist', [FrontendController::class, 'wishlist'])->name('wishlist');
Route::get('/checkout', [FrontendController::class, 'checkout'])->name('checkout');
