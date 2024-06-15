<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TiketKapalController;
use App\Http\Controllers\DeckController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage.landing');
})->name('homepage.landing');

// Auth
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [UserController::class, 'index'])->name('login.index');
    Route::post('/login', [UserController::class, 'auth'])->name('login.login');
    Route::get('/register', [UserController::class, 'form'])->name('register.index');
    Route::post('/register', [UserController::class, 'register'])->name('register.register');
});
Route::get('/logout', [UserController::class, 'logout'])->name('login.logout')->middleware('user');

// All Users
Route::group(['middleware' => 'user'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/tiket', [TiketKapalController::class, 'index'])->name('ticket');
});

// Admin
Route::group(['middleware' => 'user:admin'], function () {
    Route::get('/admin/tiket_kapal', [TiketKapalController::class, 'index'])->name('admin.tiket_kapal.index');

    //userlist
    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'userListIndex')->name('admin.userlist.index');
        Route::post('/user', 'submit')->name('admin.userlist.submit');
        Route::delete('/user/{id}', 'destroy')->name('admin.userlist.destroy');
    });

    //deck
    Route::controller(DeckController::class)->group(function () {
        Route::get('/deck', 'index')->name('admin.deck.index');
        // Route::post('/deck', 'submit')->name('admin.deck.submit');
    });
});

// User
Route::group(['middleware' => 'user:user'], function () {
    //...
});

//Data Transportasi
//..

//Tiket Kapal

//..
