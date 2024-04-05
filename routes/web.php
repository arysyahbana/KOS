<?php

use App\Http\Controllers\Admin\KostController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\ClientHomeController;
use App\Http\Controllers\Client\ClientKostController;
use App\Http\Controllers\Owner\OwnerKostController;
use App\Http\Controllers\Owner\OwnerReservationController;
use App\Http\Controllers\Owner\OwnerRoomController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ClientHomeController::class, 'show'])->name('client-panel');
Route::get('/search', [ClientHomeController::class, 'show'])->name('search-home');
Route::get('/show-kost', [ClientHomeController::class, 'show_kost'])->name('clientShow-kost');
Route::get('/search/show-kost', [ClientHomeController::class, 'show_kost'])->name('search-kost');
// Route::get('/show-owner', [ClientHomeController::class, 'show_owner'])->name('clientShow-owner');
Route::get('/kost-client/rooms/{id}', [ClientHomeController::class, 'detail_kost'])->name('roomClient-show');
Route::get('/search/detail-room/{id}', [ClientHomeController::class, 'detail_kost'])->name('search-room');
Route::get('/room-client/detail/{id}', [ClientHomeController::class, 'detail_room'])->name('roomDetail-show');
Route::get('/show-reservation/{id}', [ClientHomeController::class, 'show_res'])->name('clientShow-res')->middleware('auth');
Route::post('/reservation-client/{id}', [ClientHomeController::class, 'reservation'])->name('reservasiClient-update')->middleware('auth');

// Client-Profile
Route::prefix('profile-client')->group(function () {
    Route::get('/show', [ProfileController::class, 'edit_client'])->name('profileClient-show');
    Route::post('/update/{id}', [ProfileController::class, 'update_client'])->name('profileClient-update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile-destroy');
});
//end Client-Profile

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    // Menu Admin
    Route::get('/home-admin', function () {
        $page = 'dashboard-admin';
        return view('admin.index', compact('page'));
    })->name('admin-panel');

    // Admin-User
    Route::prefix('users-admin')->group(function () {
        Route::get('/show', [UserController::class, 'show'])->name('user-show');
        Route::get('/add', [UserController::class, 'add'])->name('user-add');
        Route::post('/store', [UserController::class, 'store'])->name('user-store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user-edit');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('user-update');
        Route::get('/delete/{id}', [UserController::class, 'destroy'])->name('user-delete');
    });
    // end Admin-User

    // Admin-Kosts
    Route::prefix('kosts-admin')->group(function () {
        Route::get('/show', [KostController::class, 'show'])->name('kost-show');
        Route::get('/add', [KostController::class, 'add'])->name('kost-add');
        Route::post('/store', [KostController::class, 'store'])->name('kost-store');
        Route::get('/edit/{id}', [KostController::class, 'edit'])->name('kost-edit');
        Route::post('/update/{id}', [KostController::class, 'update'])->name('kost-update');
        Route::get('/delete/{id}', [KostController::class, 'destroy'])->name('kost-delete');
    });
    // end Admin-Kosts

    // Admin-Rooms
    Route::prefix('room-admin')->group(function () {
        Route::get('/show', [RoomController::class, 'show'])->name('room-show');
        Route::get('/add', [RoomController::class, 'add'])->name('room-add');
        Route::post('/store', [RoomController::class, 'store'])->name('room-store');
        Route::get('/edit/{id}', [RoomController::class, 'edit'])->name('room-edit');
        Route::post('/update/{id}', [RoomController::class, 'update'])->name('room-update');
        Route::get('/delete/{id}', [RoomController::class, 'destroy'])->name('room-delete');
    });
    // end Admin-Rooms

    // Admin-Reservation
    Route::prefix('reservations-admin')->group(function () {
        Route::get('/show', [ReservationController::class, 'show'])->name('res-show');
        Route::get('/delete/{id}', [ReservationController::class, 'destroy'])->name('res-delete');
    });
    // end Admin-Reservation

    // Admin & Owner-Profile
    Route::prefix('profile')->group(function () {
        Route::get('/show', [ProfileController::class, 'edit'])->name('profile-show');
        Route::post('/update/{id}', [ProfileController::class, 'update'])->name('profile-update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile-destroy');
    });
    //end Admin & Owner-Profile

    // end Menu Admin

    // Menu Owner
    Route::get('/home-owner', function () {
        $page = 'dashboard-owner';
        return view('owner.index', compact('page'));
    })->name('owner-panel');

    // Owner-Kost
    Route::prefix('kost-owner')->group(function () {
        Route::get('/show', [OwnerKostController::class, 'show'])->name('kostOwner-show');
        Route::get('/add', [OwnerKostController::class, 'add'])->name('kostOwner-add');
        Route::post('/store', [OwnerKostController::class, 'store'])->name('kostOwner-store');
        Route::get('/edit/{id}', [OwnerKostController::class, 'edit'])->name('kostOwner-edit');
        Route::post('/update/{id}', [OwnerKostController::class, 'update'])->name('kostOwner-update');
        Route::get('/delete/{id}', [OwnerKostController::class, 'destroy'])->name('kostOwner-delete');
    });
    // end Owner-Kost

    // Owner-Room
    Route::prefix('room-owner')->group(function () {
        Route::get('/add', [OwnerRoomController::class, 'add'])->name('roomOwner-add');
        Route::post('/store', [OwnerRoomController::class, 'store'])->name('roomOwner-store');
        Route::get('/edit/{id}', [OwnerRoomController::class, 'edit'])->name('roomOwner-edit');
        Route::post('/update/{id}', [OwnerRoomController::class, 'update'])->name('roomOwner-update');
        Route::get('/delete/{id}', [OwnerRoomController::class, 'destroy'])->name('roomOwner-delete');
    });
    // end Owner-Room

    // Owner-Reservasi
    Route::prefix('reservation-owner')->group(function () {
        Route::get('/show', [OwnerReservationController::class, 'show'])->name('resOwner-show');
        Route::post('/update/{id}', [OwnerReservationController::class, 'status'])->name('resOwner-update');
        Route::get('/delete/{id}', [OwnerReservationController::class, 'destroy'])->name('resOwner-delete');
    });
    // end Owner-Reservasi
    // end Menu-Owner
});
