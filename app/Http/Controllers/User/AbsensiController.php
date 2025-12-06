<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Kegiatan;
use App\Models\PesertaKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AbsensiController extends Controller
{

    public function index()
    {

        $kegiatan = Kegiatan::whereHas('peserta', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->orderBy('tanggal', 'desc')
            ->get();

        $absensiUser = Absensi::where('user_id', auth()->id())
            ->get()
            ->keyBy('kegiatan_id');

        return view('user.absensi.index', compact('kegiatan', 'absensiUser'));
    }

    public function store(Request $request, $kegiatanId)
{
    $kegiatan = Kegiatan::findOrFail($kegiatanId);

    $peserta = PesertaKegiatan::where('kegiatan_id', $kegiatanId)
        ->where('user_id', auth()->id())
        ->where('status', 'approved')
        ->first();

    if (! $peserta) {
        return back()->with('error', 'Kamu belum disetujui sebagai peserta kegiatan ini.');
    }

    $absensi = Absensi::where('user_id', auth()->id())
        ->where('kegiatan_id', $kegiatanId)
        ->first();

    if ($absensi && $absensi->approval_status === 'pending') {
        return back()->with('error', 'Absensi sedang menunggu persetujuan admin.');
    }

    if ($absensi && $absensi->approval_status === 'approved') {
        return back()->with('error', 'Absensi sudah disetujui, kamu tidak bisa mengirim lagi.');
    }

    $request->validate([
        'tanggal'     => 'required|date',
        'jam_hadir'   => 'required',
        'bukti_foto'  => 'required|image|max:2048',
    ]);

    if ($absensi && $absensi->bukti_foto) {
        Storage::disk('public')->delete($absensi->bukti_foto);
    }

    $foto = $request->file('bukti_foto')->store('absensi', 'public');

    if (! $absensi) {
        $absensi = new Absensi();
        $absensi->kegiatan_id = $kegiatanId;
        $absensi->user_id     = auth()->id();

        $absensi->jumlah_peserta = 1;
    }

    $absensi->tanggal         = $request->tanggal;
    $absensi->jam_hadir       = $request->jam_hadir;
    $absensi->bukti_foto      = $foto;
    $absensi->approval_status = 'pending';
    $absensi->save();

    return back()->with('success', 'Absensi berhasil dikirim. Menunggu persetujuan admin.');
}
}
