<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ReservationController;
use App\Http\Middleware\checkAdminMiddlware;
use App\Models\Room;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/// Rooms routes
Route::get('/', [RoomController::class, 'index'])->name('room.index');
Route::get('/room/{id}', [RoomController::class, 'show'])->name('room.show');

Route::get('/dashboard/room/create', [RoomController::class, 'create'])->middleware(['auth',  checkAdminMiddlware::class])->name('room.create');

Route::get('/dashboard/rooms', [Roomcontroller::class, 'getAll'])->middleware(['auth', checkAdminMiddlware::class])->name('room.all');

Route::post('/dashboard/room/store', [Roomcontroller::class, 'store'])->middleware(['auth', checkAdminMiddlware::class])->name('room.store');

Route::delete('/dashboard/room/delete/{room}', [RoomController::class, 'delete'])->middleware(['auth', checkAdminMiddlware::class])->name('room.delete');
require __DIR__.'/auth.php';

// Messages routes
Route::post('/message/send', [MessageController::class, 'send'])->name('message.send');

// Reservation routes
Route::post('/rooms/reservation/{room}', [ReservationController::class, 'make'])->middleware(['auth'])->name("reservation.make");

Route::get('/dashboard/reservations', [ReservationController::class, "index"])->middleware(['auth', checkAdminMiddlware::class])->name("reservation.index");
