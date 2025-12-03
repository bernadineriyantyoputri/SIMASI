<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kegiatan;
use App\Models\PesertaKegiatan;

class KegiatanController extends Controller
{

    public function index()
    {
        $kegiatan = Kegiatan::withCount('peserta')
                    ->orderBy('tanggal', 'asc')
                    ->get();

        return view('user.kegiatan.index', compact('kegiatan'));
    }

    public function detail($id)
    {
        $kegiatan = Kegiatan::withCount('peserta')->findOrFail($id);

        $isRegistered = PesertaKegiatan::where('kegiatan_id', $id)
        ->where('user_id', Auth::id())
        ->exists();

        return view('user.kegiatan.detail', [
            'kegiatan' => $kegiatan,
            'jumlahPeserta' => $kegiatan->peserta_count,
            'isRegistered' => $isRegistered
        ]);
    }

    public function daftar(Request $request, $id)
    {
        $kegiatan = Kegiatan::withCount('peserta')->findOrFail($id);
        $userId = Auth::id();

        // Cek sudah daftar
        if (PesertaKegiatan::where('kegiatan_id', $id)->where('user_id', $userId)->exists()) {
            return back()->with('error', 'Anda sudah mendaftar kegiatan ini.');
        }

        // Cek kuota
        if ($kegiatan->peserta_count >= $kegiatan->kuota) {
            return back()->with('error', 'Kuota kegiatan sudah penuh.');
        }

        // Tambah peserta
        PesertaKegiatan::create([
            'kegiatan_id' => $id,
            'user_id' => $userId,
        ]);

        return back()->with('success', 'Berhasil mendaftar kegiatan!');
    }

    public function batal(Request $request, $id)
    {
        $userId = Auth::id();

        $peserta = PesertaKegiatan::where('kegiatan_id', $id)
                    ->where('user_id', $userId)
                    ->first();

        if (!$peserta) {
            return back()->with('error', 'Anda belum mendaftar.');
        }

        $peserta->delete();

        return back()->with('success', 'Pendaftaran berhasil dibatalkan.');
    }

    public function peserta($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $peserta = PesertaKegiatan::where('kegiatan_id', $id)->with('user')->get();

        return view('user.kegiatan.peserta', compact('kegiatan', 'peserta'));
    }
}
