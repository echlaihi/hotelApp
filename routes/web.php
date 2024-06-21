<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ReservationController;
use App\Http\Middleware\checkAdminMiddlware;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;

Route::get('/dashboard', [DashboardController::class, 'getUserDashboard'])->middleware(['auth', 'verified'])->name('user.dashboard');

Route::delete('/dashboard/users/{user}/delete', [UserController::class, 'delete'])->middleware(['auth', checkAdminMiddlware::class])->name('user.delete');

Route::get('/admin/dashboard', [DashboardController::class, 'getAdminDashboard'])->middleware(['auth', 'verified',checkAdminMiddlware::class])->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/dashboard/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/// Rooms routes
Route::get('/', [RoomController::class, 'index'])->name('room.index');
Route::get('/room/{room}', [RoomController::class, 'show'])->name('room.show');



Route::get('/admin/dashboard/room/create', [RoomController::class, 'create'])->middleware(['auth',  checkAdminMiddlware::class])->name('room.create');
Route::get('/admin/dashboard/room/{room}/edit', [RoomController::class, 'edit'])->middleware(['auth',  checkAdminMiddlware::class])->name('room.edit');
Route::put('/admin/dashboard/room/{room}/update', [RoomController::class, 'update'])->middleware(['auth',  checkAdminMiddlware::class])->name('room.update');

Route::get('/admin/dashboard/rooms', [Roomcontroller::class, 'getAll'])->middleware(['auth', checkAdminMiddlware::class])->name('admin.rooms.list');

Route::post('/admin/dashboard/room/store', [Roomcontroller::class, 'store'])->middleware(['auth', checkAdminMiddlware::class])->name('room.store');

Route::delete('/admin/dashboard/room/delete/{room}', [RoomController::class, 'delete'])->middleware(['auth', checkAdminMiddlware::class])->name('room.delete');

Route::get('/admin/dashboard/profile', [ProfileController::class, 'edit'])->middleware(['auth', checkAdminMiddlware::class])->name('adminProfile.edit');



Route::get('/admin/dashboard/reservations/{num_per_page?}', [ReservationController::class, "index"])->middleware(['auth', checkAdminMiddlware::class])->name("admin.reservations.list");

Route::get('/admin/dashboard/users', [UserController::class, 'list'])->middleware(['auth', checkAdminMiddlware::class])->name("admin.users.list");

Route::get('/admin/dashboard/messages/{type}/', [MessageController::class, 'list'])->middleware(['auth', checkAdminMiddlware::class])->name('admin.messages.list');

Route::delete('admin/dashboard/reservation/{reservation}', [ReservationController::class, 'delete'])->middleware(['auth', checkAdminMiddlware::class])->name('admin.reservation.delete');

Route::put('/admin/dashboard/reservation/{reservation}/{status}', [ReservationController::class, 'update'])->middleware(['auth', checkAdminMiddlware::class])->name('admin.reservation.update');


// Authentication routes
require __DIR__.'/auth.php';

// Messages routes
Route::get('/dashboard/messages/{type}', [MessageController::class, 'list'])->middleware('auth')->name('messages.list');
Route::post('/message/send', [MessageController::class, 'send'])->name('message.send');
Route::put('/api/message/{message}/read', [MessageController::class, 'read'])->name('message.read');


// Reservation routes
Route::post('/rooms/reservation/{room}', [ReservationController::class, 'make'])->middleware(['auth'])->name("reservation.make");

Route::delete('/dashboard/reservation/{reservation}', [ReservationController::class, 'delete'])->middleware(['auth'])->name('reservation.delete');

Route::get('/checkout', function (Request $request) {
    $stripePriceId = 'price_deluxe_album';

    $quantity = 1;

    return $request->user()->checkout([$stripePriceId => $quantity], [
        'success_url' => route('checkout-success'),
        'cancel_url' => route('checkout-cancel'),
    ]);
})->name('checkout');

Route::view('/checkout/success', function(){dd("success"); })->name('checkout-success');
Route::view('/checkout/cancel', function(){dd('cancel'); })->name('checkout-cancel');






