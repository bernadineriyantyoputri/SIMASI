<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Proses login.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Cari user berdasarkan email dulu
        $user = User::where('email', $request->email)->first();

        /**
         * ❗ FILTERNYA DI SINI:
         * - HANYA kalau role = 'user'
         * - dan is_verified = false
         * - maka TOLAK login dan suruh cek OTP
         *
         * Admin (role 'admin') TIDAK dicek is_verified,
         * jadi admin boleh login tanpa OTP.
         */
        if ($user && $user->role === 'user' && ! $user->is_verified) {
            return back()->withErrors([
                'email' => 'Akun belum diverifikasi. Silakan cek email untuk kode OTP.',
            ])->onlyInput('email');
        }

        // Proses autentikasi biasa (cek email + password)
        $request->authenticate();
        $request->session()->regenerate();

        // Jika admin → dashboard admin
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Jika user biasa → halaman kegiatan user
        return redirect()->route('user.kegiatan.index');
    }

    /**
     * Logout.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
