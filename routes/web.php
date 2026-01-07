<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [HomeController::class, 'about']);

Route::get('/rooms', [RoomController::class, 'index']);
Route::get('/rooms/{id}', [RoomController::class, 'show']);

Route::middleware('auth')->group(function () {
    Route::get('/booking/{room}', [BookingController::class, 'create']);
    Route::post('/booking', [BookingController::class, 'store']);
    Route::get('/my-bookings', [BookingController::class, 'index']);
});

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/admin/rooms', [AdminController::class, 'rooms']);
});
