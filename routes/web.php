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
| DEFAULT → redirect ke LOGIN
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect('/login');
});

/*
|--------------------------------------------------------------------------
| LOGIN ADMIN
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

/*
|--------------------------------------------------------------------------
| ROUTE ADMIN (middleware: auth + admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', [AdminController::class, 'index'])->name('dashboard');

        Route::resource('user', PenggunaController::class);
        Route::resource('kegiatan', AdminKegiatan::class);
        Route::resource('absensi', AdminAbsensi::class);
        Route::resource('kas', AdminKas::class);
    });

/*
|--------------------------------------------------------------------------
| ROUTE USER / MEMBER (middleware: auth + verified)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])
    ->name('user.')
    ->group(function () {

        // Dashboard diarahkan ke daftar kegiatan
        Route::get('/dashboard', function () {
            return redirect()->route('user.kegiatan.index');
        })->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | KEGIATAN USER
        |--------------------------------------------------------------------------
        */
        Route::get('/kegiatan', [UserKegiatan::class, 'index'])->name('kegiatan.index');
        Route::get('/kegiatan/{id}', [UserKegiatan::class, 'detail'])->name('kegiatan.detail');

        // Daftar kegiatan (POST)
        Route::post('/kegiatan/{id}/daftar', [UserKegiatan::class, 'daftar'])
            ->name('kegiatan.daftar');

        // Batal daftar kegiatan (POST)
        Route::post('/kegiatan/{id}/batal', [UserKegiatan::class, 'batal'])
            ->name('kegiatan.batal');

        // Lihat semua peserta kegiatan (GET)
        Route::get('/kegiatan/{id}/peserta', [UserKegiatan::class, 'peserta'])
            ->name('kegiatan.peserta');

        /*
        |--------------------------------------------------------------------------
        | ABSENSI USER
        |--------------------------------------------------------------------------
        */
        Route::get('/absensi', [UserAbsensi::class, 'index'])->name('absensi.index');

        /*
        |--------------------------------------------------------------------------
        | RIWAYAT USER
        |--------------------------------------------------------------------------
        */
        Route::get('/riwayat', [UserRiwayat::class, 'index'])->name('riwayat.index');

        /*
        |--------------------------------------------------------------------------
        | PROFILE USER
        |--------------------------------------------------------------------------
        */
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

/*
|--------------------------------------------------------------------------
| AUTH BREEZE
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
