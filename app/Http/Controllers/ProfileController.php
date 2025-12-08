<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profil (read only)
     * /profile
     */
    public function show()
    {
        $user = Auth::user();   // bisa admin atau user biasa

        return view('profile.show', compact('user'));
    }

    /**
     * Tampilkan form edit profil
     * /profile/edit
     */
    public function edit()
    {
        $user = Auth::user();

        return view('profile.edit', compact('user'));
    }

    /**
     * Simpan perubahan profil
     * PATCH /profile
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'npm'   => ['nullable', 'string', 'max:30', 'unique:users,npm,' . $user->id],
            'photo' => ['nullable', 'image', 'max:2048'], // 2MB
        ]);

        // Handle upload foto baru
        if ($request->hasFile('photo')) {
            // Hapus foto lama kalau ada
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            $data['photo'] = $request->file('photo')->store('profile-photos', 'public');
        }

        // Update data user (admin atau user biasa)
        $user->update($data);

        // Setelah simpan, balik lagi ke halaman profil
        return redirect()
            ->route('profile.show')
            ->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * (Opsional) Hapus akun sendiri — kalau tidak dipakai, boleh kosong / diabaikan.
     */
    public function destroy(Request $request)
    {
        // Untuk proyek ini sepertinya tidak perlu fitur hapus akun sendiri.
        abort(404);
    }
}
