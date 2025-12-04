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
    // HALAMAN ABSENSI USER
    // ============================
    public function index()
    {
        // Semua kegiatan yang user ini IKUTI dan SUDAH DISETUJUI
        $kegiatan = Kegiatan::whereHas('peserta', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->orderBy('tanggal', 'desc')
            ->get();

        // Absensi user saat ini, di-key per kegiatan_id
        $absensiUser = Absensi::where('user_id', auth()->id())
            ->get()
            ->keyBy('kegiatan_id');

        return view('user.absensi.index', compact('kegiatan', 'absensiUser'));
    }

    // ============================
    // USER MENGIRIM / MENGULANG ABSENSI
    // ============================
    public function store(Request $request, $kegiatanId)
    {
        $kegiatan = Kegiatan::findOrFail($kegiatanId);

        // Pastikan user memang peserta yang approved
        $peserta = PesertaKegiatan::where('kegiatan_id', $kegiatanId)
            ->where('user_id', auth()->id())
            ->where('status', 'approved')
            ->first();

        if (! $peserta) {
            return back()->with('error', 'Kamu belum disetujui sebagai peserta kegiatan ini.');
        }

        // Cari absensi lama (kalau ada)
        $absensi = Absensi::where('user_id', auth()->id())
            ->where('kegiatan_id', $kegiatanId)
            ->first();

        // 🚫 Jika status masih pending → tidak boleh kirim lagi
        if ($absensi && $absensi->approval_status === 'pending') {
            return back()->with(
                'error',
                'Absensi kamu sudah dikirim dan sedang menunggu persetujuan admin.'
            );
        }

        // 🚫 Jika sudah approved → tidak boleh kirim lagi
        if ($absensi && $absensi->approval_status === 'approved') {
            return back()->with(
                'error',
                'Absensi kamu sudah disetujui admin. Kamu tidak perlu mengirim absensi lagi.'
            );
        }

        // Sampai sini: kondisi yang diizinkan hanya:
        // - belum pernah absen ( $absensi == null ), atau
        // - status sebelumnya "rejected" → boleh kirim ulang

        $request->validate([
            'tanggal'     => ['required', 'date'],
            'jam_hadir'   => ['required'],
            'bukti_foto'  => ['required', 'image', 'max:2048'], // max 2MB
        ]);

        // Kalau ada dan punya foto lama → hapus fotonya (kasus: status sebelumnya rejected)
        if ($absensi && $absensi->bukti_foto) {
            Storage::disk('public')->delete($absensi->bukti_foto);
        }

        // Simpan foto baru
        $pathFoto = $request->file('bukti_foto')->store('absensi', 'public');

        if (! $absensi) {
            // Belum pernah absen → buat baru
            $absensi = new Absensi();
            $absensi->kegiatan_id    = $kegiatanId;
            $absensi->user_id        = auth()->id();

            // Kolom lama di tabel absensi yang NOT NULL
            $absensi->jumlah_peserta = 1;       // supaya tidak NULL
            $absensi->status         = 'Hadir'; // default lama, aman
        }

        // Update data absensi
        $absensi->tanggal         = $request->tanggal;
        $absensi->jam_hadir       = $request->jam_hadir;
        $absensi->bukti_foto      = $pathFoto;
        $absensi->approval_status = 'pending'; // setiap submit ulang → pending lagi
        $absensi->save();

        return back()->with('success', 'Absensi berhasil dikirim. Menunggu persetujuan admin.');
    }
}
