<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// ADMIN
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\KegiatanController as AdminKegiatan;
use App\Http\Controllers\Admin\AbsensiController as AdminAbsensi;
use App\Http\Controllers\Admin\KasController as AdminKas;

// USER
use App\Http\Controllers\User\KegiatanController as UserKegiatan;
use App\Http\Controllers\User\AbsensiController as UserAbsensi;
use App\Http\Controllers\User\RiwayatController as UserRiwayat;


/*
|--------------------------------------------------------------------------
| DEFAULT → redirect ke login
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login'); // login dari Breeze
});


/*
|--------------------------------------------------------------------------
| LOGIN ADMIN (CUSTOM)
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');


/*
|--------------------------------------------------------------------------
| ROUTE ADMIN (MIDDLEWARE)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', [AdminController::class, 'index'])->name('dashboard');

        Route::get('kegiatan/{id}/peserta', [AdminKegiatan::class, 'peserta'])
            ->name('kegiatan.peserta');

        // Gunakan resource pengguna
        Route::resource('pengguna', PenggunaController::class);

        Route::resource('kegiatan', AdminKegiatan::class);
        Route::resource('absensi', AdminAbsensi::class);
        Route::resource('kas', AdminKas::class);
    });


/*
|--------------------------------------------------------------------------
| ROUTE USER (BREEZE LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])
    ->group(function () {

        Route::get('/dashboard', function () {
            return redirect()->route('user.kegiatan.index');
        })->name('user.dashboard');

        // USER FEATURE
        Route::prefix('user')->name('user.')->group(function () {
            Route::get('/kegiatan', [UserKegiatan::class, 'index'])->name('kegiatan.index');
            Route::get('/kegiatan/{id}', [UserKegiatan::class, 'detail'])->name('kegiatan.detail');
            Route::post('/kegiatan/{id}/daftar', [UserKegiatan::class, 'daftar'])->name('kegiatan.daftar');
            Route::post('/kegiatan/{id}/batal', [UserKegiatan::class, 'batal'])->name('kegiatan.batal');
            Route::get('/kegiatan/{id}/peserta', [UserKegiatan::class, 'peserta'])->name('kegiatan.peserta');

            Route::get('/absensi', [UserAbsensi::class, 'index'])->name('absensi.index');
            Route::get('/riwayat', [UserRiwayat::class, 'index'])->name('riwayat.index');
        });

        // BREEZE PROFILE (JANGAN DIKASIH PREFIX user.)
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

// BREEZE Auth
require __DIR__ . '/auth.php';
