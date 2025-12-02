<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    public function index() {
        $kegiatan = Kegiatan::withCount('peserta')
        ->orderBy('tanggal', 'desc')
        ->get();
        return view('admin.kegiatan.index', compact('kegiatan'));
    }

    public function create() {
        return view('admin.kegiatan.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kuota' => 'required|integer|min:1',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload gambar
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('kegiatan', 'public');
        }

        Kegiatan::create([
            'judul' => $request->nama_kegiatan,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'kuota' => $request->kuota,
            'gambar' => $gambarPath,
            'user_id' => auth()->id(), // hubungkan dengan user yang login
        ]);


        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil ditambahkan');
    }

    public function edit(Kegiatan $kegiatan) {
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request, Kegiatan $kegiatan) {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kuota' => 'required|integer|min:1',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload gambar baru jika ada
        if ($request->hasFile('gambar')) {

            // Hapus gambar lama jika ada
            if ($kegiatan->gambar && Storage::disk('public')->exists($kegiatan->gambar)) {
                Storage::disk('public')->delete($kegiatan->gambar);
            }

            $gambarPath = $request->file('gambar')->store('kegiatan', 'public');
        } else {
            $gambarPath = $kegiatan->gambar; // tetap pakai gambar lama
        }

        $kegiatan->update([
            'judul' => $request->nama_kegiatan,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'kuota' => $request->kuota,
            'gambar' => $gambarPath
        ]);

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil diupdate');
    }

    public function destroy(Kegiatan $kegiatan) {

        // Hapus file gambarnya dari storage
        if ($kegiatan->gambar && Storage::disk('public')->exists($kegiatan->gambar)) {
            Storage::disk('public')->delete($kegiatan->gambar);
        }

        // Hapus data kegiatan
        $kegiatan->delete();

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil dihapus');
    }

      public function show($id)
{
    $kegiatan = Kegiatan::find($id);

    if (!$kegiatan) {
        abort(404); // jika kegiatan tidak ditemukan
    }

    // Hitung jumlah peserta
    $jumlahPeserta = $kegiatan->peserta()->count();

    return view('admin.kegiatan.show', compact('kegiatan', 'jumlahPeserta'));
}

public function peserta($id)
{
    $kegiatan = Kegiatan::findOrFail($id);
    $peserta = \App\Models\PesertaKegiatan::where('kegiatan_id', $id)
                ->with('user')
                ->get();

    return view('admin.kegiatan.peserta', compact('kegiatan', 'peserta'));
}

}

