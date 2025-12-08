<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    /**
     * Tampilkan form input OTP.
     */
    public function show(Request $request)
    {
        $email = session('otp_email');

        if (! $email) {
            return redirect()->route('register');
        }

        return view('auth.verify-otp', [
            'email' => $email,
        ]);
    }

    /**
     * Proses verifikasi OTP.
     */
    public function verify(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'otp'   => ['required', 'digits:6'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        if (! $user->otp_code || ! $user->otp_expires_at) {
            return back()->withErrors(['otp' => 'OTP belum dibuat.']);
        }

        if (now()->gt($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'Kode OTP sudah kedaluwarsa.']);
        }

        if ($user->otp_code !== $request->otp) {
            return back()->withErrors(['otp' => 'Kode OTP salah.']);
        }

        // OTP valid -> verifikasi user
        $user->is_verified    = true;
        $user->otp_code       = null;
        $user->otp_expires_at = null;
        $user->save();

        // Bersihkan session OTP
        $request->session()->forget('otp_email');

        // Login user
        Auth::login($user);

        // Langsung arahkan ke halaman kegiatan user
        return redirect()
            ->route('user.kegiatan.index')
            ->with('success', 'Akun berhasil diverifikasi.');
    }
}
