<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Auth\OtpController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\KegiatanController as AdminKegiatan;
use App\Http\Controllers\Admin\AbsensiController as AdminAbsensi;
use App\Http\Controllers\Admin\KasController as AdminKas;

use App\Http\Controllers\User\KegiatanController as UserKegiatan;
use App\Http\Controllers\User\AbsensiController as UserAbsensi;
use App\Http\Controllers\User\RiwayatController as UserRiwayat;

// ======================================
// ROOT → paksa ke login
// ======================================
Route::get('/', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
});

// ======================================
// OTP (GUEST SAJA)
// ======================================
Route::middleware('guest')->group(function () {
    Route::get('/verify-otp', [OtpController::class, 'show'])->name('otp.show');
    Route::post('/verify-otp', [OtpController::class, 'verify'])->name('otp.verify');
});

// ======================================
// ADMIN AREA
// ======================================
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');

        // PROFIL ADMIN (INI YANG KITA TAMBAH)
        Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
        Route::get('/profile/edit', [AdminController::class, 'editProfile'])->name('profile.edit');
        Route::post('/profile/update', [AdminController::class, 'updateProfile'])->name('profile.update');

        // Kegiatan & peserta
        Route::get('kegiatan/{id}/peserta', [AdminKegiatan::class, 'peserta'])->name('kegiatan.peserta');
        Route::patch('kegiatan/{kegiatan}/peserta/{peserta}/approve', [AdminKegiatan::class, 'approvePeserta'])
            ->name('kegiatan.peserta.approve');

        // Resource admin
        Route::resource('pengguna', PenggunaController::class);
        Route::resource('kegiatan', AdminKegiatan::class);
        Route::resource('absensi', AdminAbsensi::class);
        Route::resource('kas', AdminKas::class);
    });

// ======================================
// USER AREA + PROFIL (UMUM) – TIDAK DIUBAH
// ======================================
Route::middleware(['auth'])->group(function () {

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

    // PROFIL UMUM (USER / ADMIN bisa pakai kalau mau)
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
