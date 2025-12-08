<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // DASHBOARD ADMIN
    public function index()
    {
        return view('admin.dashboard');
    }

    // ==========================
    // PROFIL ADMIN (TAMPILAN)
    // ==========================
    public function profile()
    {
        $admin = Auth::user(); // sudah pasti admin (karena middleware 'admin')

        // PERHATIKAN: 'admin.profile.show' (pakai 'profile', bukan 'profil')
        return view('admin.profile.show', compact('admin'));
    }

    // ==========================
    // FORM EDIT PROFIL ADMIN
    // ==========================
    public function editProfile()
    {
        $admin = Auth::user();

        return view('admin.profile.edit', compact('admin'));
    }

    // ==========================
    // UPDATE PROFIL ADMIN
    // ==========================
    public function updateProfile(Request $request)
    {
        $admin = Auth::user();

        $data = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $admin->id],
            'npm'   => ['nullable', 'string', 'max:30', 'unique:users,npm,' . $admin->id],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);

        // Kalau upload foto baru
        if ($request->hasFile('photo')) {
            // Hapus foto lama kalau ada
            if ($admin->photo && Storage::disk('public')->exists($admin->photo)) {
                Storage::disk('public')->delete($admin->photo);
            }

            $data['photo'] = $request->file('photo')->store('profile-photos', 'public');
        }

        $admin->update($data);

        return redirect()
            ->route('admin.profile.show')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}
