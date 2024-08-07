<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeckController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KapalController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\TiketKapalController;
use App\Http\Controllers\TransportasiController;
use App\Http\Controllers\Landing\TiketController;
use App\Http\Controllers\Landing\TravelController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\Transaksi_TransportasiController;

Route::get('/', function () {
    return view('homepage.landing');
})->name('homepage.landing');

Route::get('/pesan-tiket', [TiketController::class, 'index'])->name('pesan-tiket.index');
Route::get('/pesan-travel', [TravelController::class, 'index'])->name('pesan-travel.index');
Route::get('/result/show-tiket', [TiketController::class, 'show'])->name('tiket.result.show_tiket');
Route::get('/api/kapal', [KapalController::class, 'get_data'])->name('api.kapal');
Route::get('/api/jadwal', [JadwalController::class, 'get_data'])->name('api.jadwal');
Route::get('/api/total-tiket', [JadwalController::class, 'get_total_tiket'])->name('api.total_tiket');
Route::get('/api/transportasi', [TransportasiController::class, 'get_data'])->name('api.transportasi');

// Guests Routes (Belum Login)
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [UserController::class, 'index'])->name('login.index');
    Route::post('/login', [UserController::class, 'auth'])->name('login.login');
    Route::get('/register', [UserController::class, 'form'])->name('register.index');
    Route::post('/register', [UserController::class, 'register'])->name('register.register');
});

// All Role Routes
Route::group(['middleware' => 'user'], function () {
    Route::get('/logout', [UserController::class, 'logout'])->name('login.logout');
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('/profile', [UserController::class, 'edit_profile'])->name('user.profile.edit');
    Route::post('/profile/password', [UserController::class, 'change_password'])->name('user.profile.password');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/tiket', [TiketKapalController::class, 'index'])->name('ticket');
    Route::get('/deck', [DeckController::class, 'index'])->name('deck.index');
    Route::get('/kapal', [KapalController::class, 'index'])->name('kapal.index');
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
    Route::post('/transaksi-tiket', [TiketKapalController::class, 'transaksi'])->name('tiket.transaksi');

    Route::controller(TransaksiController::class)->group(function () {
        Route::get('/transaksi', 'index')->name('transaksi.index');
        Route::get('/api/transaksi/expired', 'expired')->name('api.transaksi.expired');
        Route::post('/transaksi/bayar', 'bayar')->name('transaksi.tiket.bayar');
        Route::get('/transaksi/cancel/{id}', 'cancel')->name('tansaksi.tiket.cancel');
    });

    Route::controller(Transaksi_TransportasiController::class)->group(function () {
        Route::post('/transaksi-transportasi', 'transaksi')->name('transportasi.transaksi');
        Route::get('/transaksi-transportasi', 'index')->name('transportasi.index');
        Route::post('/transaksi-transportasi/bayar', 'bayar')->name('transportasi.bayar');
        Route::post('/transaksi-transportasi/selesai', 'selesai')->name('transportasi.selesai');
        Route::get('/transaksi-transportasi/cancel/{id}', 'cancel')->name('transportasi.cancel');
    });

    Route::controller(TiketKapalController::class)->group(function(){
        Route::get('/tiket', 'index')->name('tiket.index');
    });
});

// Admin Routes Only
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
        Route::post('/deck', 'submit')->name('admin.deck.submit');
        Route::delete('/deck/{id}', 'destroy')->name('admin.deck.destroy');
        Route::put('/deck/{id}', 'edit')->name('admin.deck.edit');
    });

    //kapal
    Route::controller(KapalController::class)->group(function () {
        Route::post('/kapal', 'submit')->name('admin.kapal.submit');
        Route::delete('/kapal/{id}', 'destroy')->name('admin.kapal.destroy');
        Route::put('/kapal/{id}', 'edit')->name('admin.kapal.edit');
    });

    //jadwal
    Route::controller(JadwalController::class)->group(function () {
        Route::post('/jadwal', 'submit')->name('admin.jadwal.submit');
        Route::delete('/jadwal/{id}', 'destroy')->name('admin.jadwal.destroy');
        Route::put('/jadwal/{id}', 'edit')->name('admin.jadwal.edit');
    });

    //transportasi
    Route::controller(TransportasiController::class)->group(function () {
        Route::get('/transportasi', 'index')->name('admin.transportasi.index');
        Route::post('/transportasi', 'submit')->name('admin.transportasi.submit');
        Route::delete('/transportasi/{id}', 'destroy')->name('admin.transportasi.destroy');
        Route::put('/transportasi/{id}', 'edit')->name('admin.transportasi.edit');
    });
});

// User Routes Only
Route::group(['middleware' => 'user:user'], function () {
    //...
});
