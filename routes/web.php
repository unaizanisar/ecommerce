<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;

// Public routes
Route::get('/', function () {
    return view('auth.login');
});
Route::get('/inactive', function () {
    return view('auth.inactive');
})->name('inactive');

Route::get('/category/{id}', [ProductController::class, 'viewCategory'])->name('category.view');
Auth::routes();

// Routes that require authentication
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    
    Route::resource('users', UserController::class);
    Route::get('users/{id}/status/{status}', [UserController::class, 'updateStatus'])->name('users.updateStatus');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users/{id}', [UserController::class, 'update'])->name('users.update');
    
    Route::resource('roles', RoleController::class);
    Route::get('roles/{id}/status/{status}', [RoleController::class, 'updateStatus'])->name('roles.updateStatus');
    Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
    
    Route::resource('permissions', PermissionController::class);
    Route::get('permissions/{id}/status/{status}', [PermissionController::class, 'updateStatus'])->name('permissions.updateStatus');
    Route::get('/permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::post('/permissions/{id}', [PermissionController::class, 'update'])->name('permissions.update');
    
    // Backend
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/cart', [CartController::class, 'index']);
    
    Route::resource('orders', OrderController::class);
    Route::get('orders/{id}/status/{status}', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::post('/orders/{id}', [OrderController::class, 'update'])->name('orders.update');
    
    Route::resource('products', ProductController::class);
    Route::get('products/{id}/status/{status}', [ProductController::class, 'updateStatus'])->name('products.updateStatus');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::get('products/{id}/feature/{is_featured}', [ProductController::class, 'updateFeatured'])->name('products.updateFeatured');
    Route::get('products/{id}/home/{is_home}', [ProductController::class, 'updateHome'])->name('products.updateHome');
    
    Route::resource('categories', CategoryController::class);
    Route::get('categories/{id}/status/{status}', [CategoryController::class, 'updateStatus'])->name('categories.updateStatus');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('categories/{id}/home/{is_home}', [CategoryController::class, 'updateHome'])->name('categories.updateHome');
    
    Route::resource('customers', CustomerController::class);
    Route::get('customers/{id}/status/{status}', [CustomerController::class, 'updateStatus'])->name('customers.updateStatus');
    Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::post('/customers/{id}', [CustomerController::class, 'update'])->name('customers.update');
    
    Route::resource('banners', BannerController::class);
    Route::get('banners/{id}/status/{status}', [BannerController::class, 'updateStatus'])->name('banners.updateStatus');
    Route::get('/banners/{id}/edit', [BannerController::class, 'edit'])->name('banners.edit');
    Route::post('/banners/{id}', [BannerController::class, 'update'])->name('banners.update');
});

//Frontend
Route::get('/home',[App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');
Route::get('/product/{id}', [App\Http\Controllers\Frontend\HomeController::class, 'show'])->name('product.show');
Route::post('product/{id}/review', [App\Http\Controllers\Frontend\HomeController::class, 'storeReview'])->name('product.storeReview');
Route::get('view_products', [App\Http\Controllers\Frontend\HomeController::class, 'viewProducts'])->name('product.viewProducts');
Route::get('/contact',[App\Http\Controllers\Frontend\HomeController::class, 'contact'])->name('contact');

Route::get('/cart', [App\Http\Controllers\Frontend\CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/checkout', [CartController::class, 'placeOrder'])->name('cart.placeOrder');
Route::get('/order/done', function () {
    return view('frontend.frontend.done');
})->name('order.done');

Route::get('/category/{id}', [FrontendProductController::class, 'viewCategory'])->name('category.view');
Route::get('/search', [FrontendProductController::class, 'search'])->name('search');

Route::get('/payment',[PaymentController::class, 'index']);
Route::get('/review',[ReviewController::class, 'index']);