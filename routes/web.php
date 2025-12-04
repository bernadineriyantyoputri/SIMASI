<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
| DEFAULT → paksa logout lalu redirect ke login
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| ROUTE ADMIN (MIDDLEWARE auth + admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard admin
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');

        // Detail peserta kegiatan
        Route::get('kegiatan/{id}/peserta', [AdminKegiatan::class, 'peserta'])
            ->name('kegiatan.peserta');

        // Route approve peserta
        Route::patch('kegiatan/{kegiatan}/peserta/{peserta}/approve',
            [AdminKegiatan::class, 'approvePeserta'])
            ->name('kegiatan.peserta.approve');

        // CRUD Pengguna
        Route::resource('pengguna', PenggunaController::class);

        // CRUD Kegiatan
        Route::resource('kegiatan', AdminKegiatan::class);

        // CRUD Absensi (admin melihat & approve/reject absensi user)
        Route::resource('absensi', AdminAbsensi::class);

        // CRUD Kas
        Route::resource('kas', AdminKas::class);
    });

/*
|--------------------------------------------------------------------------
| ROUTE USER (MIDDLEWARE auth + verified)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])
    ->group(function () {

        // Dashboard user diarahkan ke daftar kegiatan
        Route::get('/dashboard', function () {
            return redirect()->route('user.kegiatan.index');
        })->name('user.dashboard');

        Route::prefix('user')->name('user.')->group(function () {

            /*
            |------------------------
            | KEGIATAN USER
            |------------------------
            */
            Route::get('/kegiatan', [UserKegiatan::class, 'index'])->name('kegiatan.index');
            Route::get('/kegiatan/{id}', [UserKegiatan::class, 'detail'])->name('kegiatan.detail');

            Route::post('/kegiatan/{id}/daftar', [UserKegiatan::class, 'daftar'])->name('kegiatan.daftar');
            Route::delete('/kegiatan/{id}/batal', [UserKegiatan::class, 'batal'])->name('kegiatan.batal');

            Route::get('/kegiatan/{id}/peserta', [UserKegiatan::class, 'peserta'])
                ->name('kegiatan.peserta');

            /*
            |------------------------
            | ABSENSI USER
            |------------------------
            */
            Route::get('/absensi', [UserAbsensi::class, 'index'])->name('absensi.index');

            // User submit absensi per kegiatan
            Route::post('/absensi/{kegiatan}', [UserAbsensi::class, 'store'])
                ->name('absensi.store');

            /*
            |------------------------
            | RIWAYAT USER
            |------------------------
            */
            Route::get('/riwayat', [UserRiwayat::class, 'index'])->name('riwayat.index');
        });

        /*
        |--------------------------------------------------------------------------
        | PROFILE (Breeze)
        |--------------------------------------------------------------------------
        */
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (BREEZE)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
