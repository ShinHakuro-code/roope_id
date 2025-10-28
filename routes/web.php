<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\GalleryController;
use App\Http\Controllers\User\AboutController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('user.home');
Route::get('/products', [ProductController::class, 'index'])->name('user.products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('user.products.show');
Route::get('/gallery', [GalleryController::class, 'index'])->name('user.gallery');
Route::get('/about', [AboutController::class, 'index'])->name('user.about');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User Routes (Protected)
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('user.cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('user.cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('user.cart.update');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('user.cart.remove');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('user.checkout');
});

// Admin Routes (Protected) - WITH INLINE MIDDLEWARE (FULL VERSION)
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return app(\App\Http\Controllers\Admin\DashboardController::class)->index();
        }
        abort(403, 'Unauthorized access');
    })->name('dashboard');

    // Products Management - FULL CRUD
    Route::get('/products', function () {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return app(\App\Http\Controllers\Admin\ProductController::class)->index();
        }
        abort(403, 'Unauthorized access');
    })->name('products');

    Route::get('/products/create', function () {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return app(\App\Http\Controllers\Admin\ProductController::class)->create();
        }
        abort(403, 'Unauthorized access');
    })->name('products.create');

    Route::post('/products', function (Request $request) {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return app(\App\Http\Controllers\Admin\ProductController::class)->store($request);
        }
        abort(403, 'Unauthorized access');
    })->name('products.store');

    Route::get('/products/{product}/edit', function ($product) {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return app(\App\Http\Controllers\Admin\ProductController::class)->edit($product);
        }
        abort(403, 'Unauthorized access');
    })->name('products.edit');

    Route::put('/products/{product}', function (Request $request, $product) {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return app(\App\Http\Controllers\Admin\ProductController::class)->update($request, $product);
        }
        abort(403, 'Unauthorized access');
    })->name('products.update');

    Route::delete('/products/{product}', function ($product) {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return app(\App\Http\Controllers\Admin\ProductController::class)->destroy($product);
        }
        abort(403, 'Unauthorized access');
    })->name('products.destroy');

    // Gallery Management - FULL CRUD
    Route::get('/gallery', function () {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return app(\App\Http\Controllers\Admin\GalleryController::class)->index();
        }
        abort(403, 'Unauthorized access');
    })->name('gallery');

    Route::get('/gallery/create', function () {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return app(\App\Http\Controllers\Admin\GalleryController::class)->create();
        }
        abort(403, 'Unauthorized access');
    })->name('gallery.create');

    Route::post('/gallery', function (Request $request) {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return app(\App\Http\Controllers\Admin\GalleryController::class)->store($request);
        }
        abort(403, 'Unauthorized access');
    })->name('gallery.store');

    Route::get('/gallery/{gallery}/edit', function ($gallery) {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return app(\App\Http\Controllers\Admin\GalleryController::class)->edit($gallery);
        }
        abort(403, 'Unauthorized access');
    })->name('gallery.edit');

    Route::put('/gallery/{gallery}', function (Request $request, $gallery) {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return app(\App\Http\Controllers\Admin\GalleryController::class)->update($request, $gallery);
        }
        abort(403, 'Unauthorized access');
    })->name('gallery.update');

    Route::delete('/gallery/{gallery}', function ($gallery) {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return app(\App\Http\Controllers\Admin\GalleryController::class)->destroy($gallery);
        }
        abort(403, 'Unauthorized access');
    })->name('gallery.destroy');

    // About Management
    Route::get('/about', function () {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return app(\App\Http\Controllers\Admin\AboutController::class)->index();
        }
        abort(403, 'Unauthorized access');
    })->name('about');

    Route::post('/about', function (Request $request) {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return app(\App\Http\Controllers\Admin\AboutController::class)->update($request);
        }
        abort(403, 'Unauthorized access');
    })->name('about.update');
});
