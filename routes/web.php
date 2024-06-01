<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ReservationController;
use App\Http\Middleware\checkAdminMiddlware;
use App\Http\Controllers\DashboardController;
use App\Models\Room;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'getUserDashboard'])->middleware(['auth', 'verified'])->name('user.dashboard');

Route::get('/admin/dashboard', [DashboardController::class, 'getAdminDashboard'])->middleware(['auth', 'verified',checkAdminMiddlware::class])->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/// Rooms routes
Route::get('/', [RoomController::class, 'index'])->name('room.index');
Route::get('/room/{room}', [RoomController::class, 'show'])->name('room.show');



Route::get('/admin/dashboard/room/create', [RoomController::class, 'create'])->middleware(['auth',  checkAdminMiddlware::class])->name('room.create');

Route::get('/admin/dashboard/rooms', [Roomcontroller::class, 'getAll'])->middleware(['auth', checkAdminMiddlware::class])->name('room.all');

Route::post('/admin/dashboard/room/store', [Roomcontroller::class, 'store'])->middleware(['auth', checkAdminMiddlware::class])->name('room.store');

Route::delete('/admin/dashboard/room/delete/{room}', [RoomController::class, 'delete'])->middleware(['auth', checkAdminMiddlware::class])->name('room.delete');
require __DIR__.'/auth.php';

// Messages routes
Route::post('/message/send', [MessageController::class, 'send'])->name('message.send');

// Reservation routes
Route::post('/rooms/reservation/{room}', [ReservationController::class, 'make'])->middleware(['auth'])->name("reservation.make");

Route::get('/admin/dashboard/reservations', [ReservationController::class, "index"])->middleware(['auth', checkAdminMiddlware::class])->name("reservation.index");
