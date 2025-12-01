<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kegiatan;
use App\Models\PesertaKegiatan;

class KegiatanController extends Controller
{
    /**
     * Tampilkan semua kegiatan.
     */
    public function index()
    {
        $kegiatan = Kegiatan::orderBy('tanggal', 'asc')->get();
        return view('user.kegiatan.index', compact('kegiatan'));
    }

    /**
     * Tampilkan detail kegiatan.
     */
    public function detail($id)
    {
        $kegiatan = Kegiatan::find($id);

        if (!$kegiatan) abort(404);

        // Hitung peserta menggunakan model PesertaKegiatan
        $jumlahPeserta = PesertaKegiatan::where('kegiatan_id', $id)->count();

        return view('user.kegiatan.detail', compact('kegiatan', 'jumlahPeserta'));
    }

    /**
     * Daftar peserta ke kegiatan (POST).
     */
    public function daftar(Request $request, $id)
    {
        $kegiatan = Kegiatan::find($id);

        if (!$kegiatan) {
            abort(404);
        }

        $userId = Auth::id();

        // Cek apakah user sudah terdaftar menggunakan model
        $sudahDaftar = PesertaKegiatan::where('kegiatan_id', $id)
                                        ->where('user_id', $userId)
                                        ->exists();

        if ($sudahDaftar) {
            return redirect()->back()->with('error', 'Anda sudah mendaftar kegiatan ini.');
        }

        // Tambahkan peserta menggunakan model
        PesertaKegiatan::create([
            'kegiatan_id' => $id,
            'user_id' => $userId,
        ]);

        return redirect()->back()->with('success', 'Berhasil mendaftar kegiatan!');

        
    }
    public function batal(Request $request, $id)
{
    $userId = auth()->id();
    
    $peserta = PesertaKegiatan::where('kegiatan_id', $id)
                ->where('user_id', $userId)
                ->first();

    if ($peserta) {
        $peserta->delete();
        return redirect()->back()->with('success', 'Pendaftaran berhasil dibatalkan.');
    }

    return redirect()->back()->with('error', 'Anda belum mendaftar kegiatan ini.');
}

// Lihat peserta kegiatan
public function peserta($id)
{
    $kegiatan = Kegiatan::findOrFail($id);

    $peserta = PesertaKegiatan::where('kegiatan_id', $id)->with('user')->get();

    return view('user.kegiatan.peserta', compact('kegiatan', 'peserta'));
}
}
