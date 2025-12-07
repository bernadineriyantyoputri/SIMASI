<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\PesertaKegiatan;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    // ============================
    // INDEX (LIST SEMUA KEGIATAN)
    // ============================
    public function index()
    {
        $kegiatan = Kegiatan::withCount('peserta')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('admin.kegiatan.index', compact('kegiatan'));
    }

    // ============================
    // FORM TAMBAH KEGIATAN
    // ============================
    public function create()
    {
        return view('admin.kegiatan.create');
    }

    // ============================
    // PROSES SIMPAN KEGIATAN BARU
    // ============================
    public function store(Request $request)
    {
        // MATIKAN VALIDASI SEMENTARA AGAR CEK INSERT
        // Setelah berhasil tersimpan, validasi kita hidupkan lagi

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('kegiatan', 'public');
        }

        Kegiatan::create([
            'judul'     => $request->nama_kegiatan,
            'tanggal'   => $request->tanggal,
            'jam'       => $request->jam,
            'lokasi'    => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'kuota'     => $request->kuota,
            'gambar'    => $gambarPath
        ]);

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil ditambahkan');
    }

    // ============================
    // FORM EDIT KEGIATAN
    // ============================
    public function edit(Kegiatan $kegiatan)
    {
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    // ============================
    // PROSES UPDATE KEGIATAN
    // ============================
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal'       => 'required|date',
            'jam'           => 'nullable',
            'lokasi'        => 'required|string|max:255',
            'deskripsi'     => 'required|string',
            'kuota'         => 'required|integer|min:1',
            'gambar'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($kegiatan->gambar && Storage::disk('public')->exists($kegiatan->gambar)) {
                Storage::disk('public')->delete($kegiatan->gambar);
            }
            $gambarPath = $request->file('gambar')->store('kegiatan', 'public');
        } else {
            $gambarPath = $kegiatan->gambar;
        }

        $kegiatan->update([
            'judul'     => $request->nama_kegiatan,
            'tanggal'   => $request->tanggal,
            'jam'       => $request->jam,
            'lokasi'    => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'kuota'     => $request->kuota,
            'gambar'    => $gambarPath
        ]);

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil diupdate');
    }

    // ============================
    // DELETE KEGIATAN
    // ============================
    public function destroy(Kegiatan $kegiatan)
    {
        if ($kegiatan->gambar && Storage::disk('public')->exists($kegiatan->gambar)) {
            Storage::disk('public')->delete($kegiatan->gambar);
        }

        $kegiatan->delete();

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil dihapus');
    }

    // ============================
    // DETAIL KEGIATAN
    // ============================
    public function show($id)
    {
        $kegiatan = Kegiatan::find($id);

        if (!$kegiatan) {
            abort(404);
        }

        $jumlahPeserta = $kegiatan->peserta()->count();

        return view('admin.kegiatan.show', compact('kegiatan', 'jumlahPeserta'));
    }

    // ============================
    // LIST PESERTA KEGIATAN
    // ============================
    public function peserta($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $peserta = PesertaKegiatan::where('kegiatan_id', $id)
            ->with('user')
            ->get();

        return view('admin.kegiatan.peserta', compact('kegiatan', 'peserta'));
    }

    // ============================
    // ADMIN SETUJUI PESERTA
    // ============================
    public function approvePeserta($kegiatanId, $pesertaId)
    {
        $peserta = PesertaKegiatan::where('id', $pesertaId)
            ->where('kegiatan_id', $kegiatanId)
            ->firstOrFail();

        $peserta->status = 'approved';
        $peserta->save();

        return back()->with('success', 'Peserta berhasil disetujui.');
    }
}
