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
    // ============================
    // LIST KEGIATAN YANG BISA DIABSEN USER
    // ============================
    public function index()
    {
        // Semua kegiatan yang diikuti user (apapun status pesertanya)
        $kegiatan = Kegiatan::whereHas('peserta', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->orderBy('tanggal', 'desc')
            ->get();

        // Absensi user, di-key per kegiatan_id
        $absensiUser = Absensi::where('user_id', auth()->id())
            ->get()
            ->keyBy('kegiatan_id');

        // STATUS KEIKUTSERTAAN USER DI SETIAP KEGIATAN
        $kepesertaan = PesertaKegiatan::where('user_id', auth()->id())
            ->whereIn('kegiatan_id', $kegiatan->pluck('id'))
            ->get()
            ->keyBy('kegiatan_id');

        return view('user.absensi.index', compact('kegiatan', 'absensiUser', 'kepesertaan'));
    }

    // ============================
    // PROSES KIRIM ABSENSI
    // ============================
    public function store(Request $request, $kegiatanId)
    {
        $kegiatan = Kegiatan::findOrFail($kegiatanId);

        // WAJIB: user hanya boleh absen kalau pesertanya sudah APPROVED
        $peserta = PesertaKegiatan::where('kegiatan_id', $kegiatanId)
            ->where('user_id', auth()->id())
            ->where('status', 'approved')
            ->first();

        if (! $peserta) {
            return back()->with('error', 'Kamu belum disetujui sebagai peserta kegiatan ini.');
        }

        // Cari absensi yang sudah pernah dikirim sebelumnya
        $absensi = Absensi::where('user_id', auth()->id())
            ->where('kegiatan_id', $kegiatanId)
            ->first();

        // Kalau masih pending, jangan boleh kirim lagi
        if ($absensi && $absensi->approval_status === 'pending') {
            return back()->with('error', 'Absensi sedang menunggu persetujuan admin.');
        }

        // Kalau sudah approved, juga tidak boleh kirim lagi
        if ($absensi && $absensi->approval_status === 'approved') {
            return back()->with('error', 'Absensi sudah disetujui, kamu tidak bisa mengirim lagi.');
        }

        // Validasi input
        $request->validate([
            'tanggal'     => 'required|date',
            'jam_hadir'   => 'required',
            'bukti_foto'  => 'required|image|max:2048',
        ]);

        // Hapus foto lama kalau ada
        if ($absensi && $absensi->bukti_foto) {
            Storage::disk('public')->delete($absensi->bukti_foto);
        }

        // Upload foto baru
        $foto = $request->file('bukti_foto')->store('absensi', 'public');

        // Jika belum ada record absensi, buat baru
        if (! $absensi) {
            $absensi = new Absensi();
            $absensi->kegiatan_id = $kegiatanId;
            $absensi->user_id     = auth()->id();
            $absensi->jumlah_peserta = 1;
        }

        // Isi data absensi
        $absensi->tanggal         = $request->tanggal;
        $absensi->jam_hadir       = $request->jam_hadir;
        $absensi->bukti_foto      = $foto;
        $absensi->approval_status = 'pending';
        $absensi->save();

        return back()->with('success', 'Absensi berhasil dikirim. Menunggu persetujuan admin.');
    }
}
