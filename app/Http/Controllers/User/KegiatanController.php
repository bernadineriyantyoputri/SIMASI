<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\PesertaKegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    // ============================
    // LIST KEGIATAN UNTUK USER
    // ============================
    public function index()
    {
        // pakai 'tanggal' (BUKAN tanggal_mulai)
        // dan withCount('peserta') supaya di Blade bisa pakai $k->peserta_count
        $kegiatan = Kegiatan::withCount('peserta')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('user.kegiatan.index', compact('kegiatan'));
    }

    // ============================
    // DETAIL KEGIATAN
    // ============================
    public function detail($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $peserta = PesertaKegiatan::where('kegiatan_id', $id)
            ->where('user_id', auth()->id())
            ->first();

        return view('user.kegiatan.detail', compact('kegiatan', 'peserta'));
    }

    // ============================
    // USER MENDAFTAR KEGIATAN
    // ============================
    public function daftar($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        // Cek apakah user sudah pernah daftar
        $existing = PesertaKegiatan::where('kegiatan_id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existing) {
            return back()->with('error', 'Kamu sudah mendaftar kegiatan ini.');
        }

        // Simpan sebagai pending
        PesertaKegiatan::create([
            'kegiatan_id' => $id,
            'user_id'     => auth()->id(),
            'status'      => 'pending',
        ]);

        return back()->with('success', 'Berhasil mendaftar. Menunggu persetujuan admin.');
    }

    // ============================
    // USER MEMBATALKAN PENDAFTARAN
    // ============================
    public function batal($id)
    {
        $peserta = PesertaKegiatan::where('kegiatan_id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $peserta->delete();

        return back()->with('success', 'Pendaftaran berhasil dibatalkan.');
    }

    // ============================
    // LIHAT PESERTA YANG DISETUJUI
    // ============================
    public function peserta($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $peserta = PesertaKegiatan::where('kegiatan_id', $id)
            ->where('status', 'approved')
            ->with('user')
            ->get();

        return view('user.kegiatan.peserta', compact('kegiatan', 'peserta'));
    }
}
