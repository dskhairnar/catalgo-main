<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\BusinessController as AdminBusinessController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Business\BusinessController;
use App\Http\Controllers\Business\BusinessBookingController;
use App\Http\Controllers\Business\BusinessProfileController;
use App\Http\Controllers\Business\ServiceController;
use App\Http\Controllers\BookingController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/services/{service}', [HomeController::class, 'showService'])->name('service.details');
Route::get('/services/{service}/book', [BookingController::class, 'create'])->name('service.book');
Route::get('/services/{service}/provider', [BusinessController::class, 'show'])->name('service.provider');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// Authentication Routes
Auth::routes();

// User Dashboard Route
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::put('/profile/update', [DashboardController::class, 'updateProfile'])->name('profile.update');
    Route::put('/password/update', [DashboardController::class, 'updatePassword'])->name('profile.password.update');
    Route::get('/bookings', [DashboardController::class, 'bookings'])->name('bookings');
    Route::post('/bookings', [DashboardController::class, 'storeBooking'])->name('bookings.store');
    Route::get('/saved', [DashboardController::class, 'saved'])->name('saved');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', AdminUserController::class);
    Route::resource('businesses', AdminBusinessController::class);
    Route::post('/businesses/{id}/approve', [AdminBusinessController::class, 'approve'])->name('businesses.approve');
    Route::post('/businesses/{id}/reject', [AdminBusinessController::class, 'reject'])->name('businesses.reject');
    Route::resource('categories', CategoryController::class);
});

// Business Routes are defined below

// Business Dashboard Routes
Route::middleware(['auth', 'role:business'])->prefix('business')->name('business.')->group(function () {
    Route::get('/dashboard', [BusinessController::class, 'dashboard'])->name('dashboard');
    Route::resource('listings', BusinessController::class);
    Route::get('/reviews', [BusinessController::class, 'reviews'])->name('reviews');
    Route::get('/services', [ServiceController::class, 'index'])->name('services');
    Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    Route::get('/services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');
    Route::get('/bookings', [BusinessBookingController::class, 'index'])->name('bookings');
    Route::patch('/bookings/{id}/status', [BusinessBookingController::class, 'updateStatus'])->name('bookings.update-status');
    Route::get('/profile', [BusinessProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update', [BusinessProfileController::class, 'update'])->name('profile.update');
});