<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Public Pages (UI)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::get('/rooms/{id}', [RoomController::class, 'show'])->name('rooms.show');

/*
|--------------------------------------------------------------------------
| Authentication (Custom – Laravel 12 compatible)
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

/*
|--------------------------------------------------------------------------
| User Booking (Authenticated Users)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/booking/{room}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/my-bookings', [BookingController::class, 'index'])->name('booking.index');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Admin Only)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/rooms', [AdminController::class, 'rooms'])->name('admin.rooms');
});
