<?php

use App\Http\Controllers\Admin\KostController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\ClientKostController;
use App\Http\Controllers\Owner\OwnerKostController;
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

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    // Admin
    Route::get('/home-admin', function () {
        $page = 'dashboard-admin';
        return view('admin.index', compact('page'));
    })->name('admin-panel');
    // User
    Route::get('/users', [UserController::class, 'show'])->name('user-show');
    Route::get('/users-add', [UserController::class, 'add'])->name('user-add');
    Route::post('/users-store', [UserController::class, 'store'])->name('user-store');
    Route::get('/users-edit/{id}', [UserController::class, 'edit'])->name('user-edit');
    Route::post('/users-update/{id}', [UserController::class, 'update'])->name('user-update');
    Route::get('/users-delete/{id}', [UserController::class, 'destroy'])->name('user-delete');
    // end User

    // Kosts
    Route::get('/kost', [KostController::class, 'show'])->name('kost-show');
    Route::get('/kost-add', [KostController::class, 'add'])->name('kost-add');
    Route::post('/kost-store', [KostController::class, 'store'])->name('kost-store');
    Route::get('/kost-edit/{id}', [KostController::class, 'edit'])->name('kost-edit');
    Route::post('/kost-update/{id}', [KostController::class, 'update'])->name('kost-update');
    Route::get('/kost-delete/{id}', [KostController::class, 'destroy'])->name('kost-delete');
    // end Kosts

    // Rooms
    Route::get('/room', [RoomController::class, 'show'])->name('room-show');
    Route::get('/room-add', [RoomController::class, 'add'])->name('room-add');
    Route::post('/room-store', [RoomController::class, 'store'])->name('room-store');
    Route::get('/room-edit/{id}', [RoomController::class, 'edit'])->name('room-edit');
    Route::post('/room-update/{id}', [RoomController::class, 'update'])->name('room-update');
    Route::get('/room-delete/{id}', [RoomController::class, 'destroy'])->name('room-delete');
    // end Rooms
    // end Admin

    // Owner
    Route::get('/home-owner', function () {
        $page = 'dashboard-owner';
        return view('owner.index', compact('page'));
    })->name('owner-panel');

    // Kost
    Route::get('/kost-owner', [OwnerKostController::class, 'show'])->name('kostOwner-show');
    Route::get('/kost-owner-add', [OwnerKostController::class, 'add'])->name('kostOwner-add');
    Route::post('/kost-owner-store', [OwnerKostController::class, 'store'])->name('kostOwner-store');
    Route::get('/kost-owner-edit/{id}', [OwnerKostController::class, 'edit'])->name('kostOwner-edit');
    Route::post('/kost-owner-update/{id}', [OwnerKostController::class, 'update'])->name('kostOwner-update');
    Route::get('/kost-owner-delete/{id}', [OwnerKostController::class, 'destroy'])->name('kostOwner-delete');
    // end Kost

    // Room
    Route::get('/room-owner-add', [OwnerRoomController::class, 'add'])->name('roomOwner-add');
    Route::post('/room-owner-store', [OwnerRoomController::class, 'store'])->name('roomOwner-store');
    Route::get('/room-owner-edit/{id}', [OwnerRoomController::class, 'edit'])->name('roomOwner-edit');
    Route::post('/room-owner-update/{id}', [OwnerRoomController::class, 'update'])->name('roomOwner-update');
    Route::get('/room-owner-delete/{id}', [OwnerRoomController::class, 'destroy'])->name('roomOwner-delete');
    // end Room
    // end Owner

    // Client
    Route::get('/home-client', function () {
        $page = 'dashboard-client';
        return view('client.index', compact('page'));
    })->name('client-panel');

    // Kost
    Route::get('/kost-client', [ClientKostController::class, 'show'])->name('kostClient-show');
    Route::get('/kost-client/rooms/{id}', [ClientKostController::class, 'detail'])->name('roomClient-show');
    // end Kost
    // end Client
});
