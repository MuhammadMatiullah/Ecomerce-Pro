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
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\SliderController;


Route::view('/', 'welcome');

Auth::routes(); 
// Admin route (use controller)

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

  
});





// Show all categories (list)




// Sub-Category routes

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth:admin']) // 👈 check authentication with admin guard
    ->group(function () {
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


    Route::get('/category', [CategoryController::class, 'category'])->name('category');
// Show create form
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
// Save category (POST)
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
// Show edit form
Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
// Update category (PUT/PATCH)
Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
// Delete
Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
 Route::get('/check-slug/product', [ProductController::class, 'checkSlug'])->name('check.slug.product');
 Route::get('/product/get-subcategories/{category_id}', [ProductController::class, 'getSubcategories'])->name('product.get.subcategories');
 Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
// 👇 Edit + Update routes
Route::get('/product/{id}/edit', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('product.edit');
Route::post('/product/{id}/update', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('product.update');
Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
 Route::get('sliders', [SliderController::class, 'index'])->name('sliders.index');

    // Show create form
    Route::get('sliders/create', [SliderController::class, 'create'])->name('slider.create');

    // Store new slider
   Route::post('sliders/store', [SliderController::class, 'store'])->name('sliders.store');


    // Show edit form
    Route::get('sliders/{id}/edit', [SliderController::class, 'edit'])->name('sliders.edit');

    // Update slider
    Route::post('sliders/{id}/update', [SliderController::class, 'update'])->name('sliders.update');

    // Delete slider
    Route::delete('sliders/{id}', [SliderController::class, 'destroy'])->name('sliders.destroy');

      Route::get('/', [AdminController::class, 'index'])
    ->name('dashboard');

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

//PRODUCT





// frontend 






Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
Route::get('/wishlist', [FrontendController::class, 'wishlist'])->name('wishlist');
Route::get('/checkout', [FrontendController::class, 'checkout'])->name('checkout');
Route::get('/product/{slug}', [FrontendController::class, 'productDetails'])->name('product.show');
Route::get('/category/{id}', [FrontendController::class, 'categoryShow'])->name('category.show');
Route::get('/subcategory/{id}', [FrontendController::class, 'subcategoryShow'])->name('subcategory.show');