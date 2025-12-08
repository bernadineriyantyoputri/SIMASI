<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Tampilkan form register.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Proses registrasi user (dengan OTP via email).
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'npm'  => ['required', 'digits:10', 'unique:users,npm'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Generate OTP 6 digit
        $otp = (string) random_int(100000, 999999);

        $user = User::create([
            'name'          => $request->name,
            'npm'           => $request->npm,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'role'          => 'user',          // sesuaikan default
            'is_verified'   => false,
            'otp_code'      => $otp,
            'otp_expires_at'=> now()->addMinutes(10),
        ]);

        event(new Registered($user));

        // Kirim email OTP ke email user (lewat Mailtrap)
        Mail::to($user->email)->send(new OtpMail($otp));

        // Simpan email ke session untuk form OTP
        session(['otp_email' => $user->email]);

        // Jangan auto-login di sini
        return redirect()->route('otp.show')
            ->with('status', 'Kami telah mengirimkan kode OTP ke email Anda.');
    }
}
