<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\KegiatanController as AdminKegiatan;
use App\Http\Controllers\Admin\AbsensiController as AdminAbsensi;
use App\Http\Controllers\Admin\KasController as AdminKas;

use App\Http\Controllers\User\KegiatanController as UserKegiatan;
use App\Http\Controllers\User\AbsensiController as UserAbsensi;
use App\Http\Controllers\User\RiwayatController as UserRiwayat;

Route::get('/', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
});

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');
        Route::get('kegiatan/{id}/peserta', [AdminKegiatan::class, 'peserta'])->name('kegiatan.peserta');
        Route::patch('kegiatan/{kegiatan}/peserta/{peserta}/approve', [AdminKegiatan::class, 'approvePeserta'])->name('kegiatan.peserta.approve');

        Route::resource('pengguna', PenggunaController::class);
        Route::resource('kegiatan', AdminKegiatan::class);
        Route::resource('absensi', AdminAbsensi::class);
        Route::resource('kas', AdminKas::class);
    });

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return redirect()->route('user.kegiatan.index');
    })->name('user.dashboard');

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/kegiatan', [UserKegiatan::class, 'index'])->name('kegiatan.index');
        Route::get('/kegiatan/{id}', [UserKegiatan::class, 'detail'])->name('kegiatan.detail');

        Route::post('/kegiatan/{id}/daftar', [UserKegiatan::class, 'daftar'])->name('kegiatan.daftar');
        Route::delete('/kegiatan/{id}/batal', [UserKegiatan::class, 'batal'])->name('kegiatan.batal');

        Route::get('/kegiatan/{id}/peserta', [UserKegiatan::class, 'peserta'])->name('kegiatan.peserta');

        Route::get('/absensi', [UserAbsensi::class, 'index'])->name('absensi.index');
        Route::post('/absensi/{kegiatan}', [UserAbsensi::class, 'store'])->name('absensi.store');

        Route::get('/riwayat', [UserRiwayat::class, 'index'])->name('riwayat.index');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
