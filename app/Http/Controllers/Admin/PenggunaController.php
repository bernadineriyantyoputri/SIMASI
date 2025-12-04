<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PenggunaController extends Controller
{
    /**
     * Tampilkan daftar semua pengguna
     * GET /admin/pengguna
     */
    public function index()
    {
        $users = User::orderBy('name')->get();

        return view('admin.pengguna.index', compact('users'));
    }

    /**
     * Form tambah pengguna baru
     * GET /admin/pengguna/create
     */
    public function create()
    {
        return view('admin.pengguna.create');
    }

    /**
     * Simpan pengguna baru
     * POST /admin/pengguna
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'email', 'max:255', 'unique:users,email'],
            'npm'                   => ['nullable', 'string', 'max:30', 'unique:users,npm'],
            'role'                  => ['required', 'in:admin,user'],
            'password'              => ['required', 'string', 'min:8', 'confirmed'],
            'photo'                 => ['nullable', 'image', 'max:2048'], // max 2MB
        ]);

        // Hash password
        $data['password'] = Hash::make($data['password']);

        // Upload foto jika ada
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('profile-photos', 'public');
        }

        User::create($data);

        return redirect()
            ->route('admin.pengguna.index')
            ->with('success', 'Pengguna berhasil ditambahkan.');
    }

    /**
     * Form edit pengguna
     * GET /admin/pengguna/{pengguna}/edit
     *
     * Route model binding: {pengguna} -> instance User
     */
    public function edit(User $pengguna)
    {
        return view('admin.pengguna.edit', [
            'pengguna' => $pengguna,
        ]);
    }

    /**
     * Update data pengguna
     * PUT/PATCH /admin/pengguna/{pengguna}
     */
    public function update(Request $request, User $pengguna)
    {
        $data = $request->validate([
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'email', 'max:255', 'unique:users,email,' . $pengguna->id],
            'npm'                   => ['nullable', 'string', 'max:30', 'unique:users,npm,' . $pengguna->id],
            'role'                  => ['required', 'in:admin,user'],
            'password'              => ['nullable', 'string', 'min:8', 'confirmed'],
            'photo'                 => ['nullable', 'image', 'max:2048'],
        ]);

        // Kalau password diisi, update. Kalau kosong, jangan diubah
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        // Kalau upload foto baru, hapus foto lama (kalau ada)
        if ($request->hasFile('photo')) {
            if ($pengguna->photo && Storage::disk('public')->exists($pengguna->photo)) {
                Storage::disk('public')->delete($pengguna->photo);
            }

            $data['photo'] = $request->file('photo')->store('profile-photos', 'public');
        }

        $pengguna->update($data);

        return redirect()
            ->route('admin.pengguna.index')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    /**
     * Hapus pengguna
     * DELETE /admin/pengguna/{pengguna}
     */
    public function destroy(User $pengguna)
    {
        // Opsional: cegah hapus diri sendiri
        if (auth()->id() === $pengguna->id) {
            return back()->with('error', 'Tidak dapat menghapus akun Anda sendiri.');
        }

        // Hapus foto kalau ada
        if ($pengguna->photo && Storage::disk('public')->exists($pengguna->photo)) {
            Storage::disk('public')->delete($pengguna->photo);
        }

        $pengguna->delete();

        return redirect()
            ->route('admin.pengguna.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}
