<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Absensi;

class RiwayatController extends Controller
{
    public function index()
    {
        // Ambil absensi yang sudah APPROVED
        $riwayat = Absensi::with('kegiatan')
            ->where('user_id', auth()->id())
            ->where('approval_status', 'approved')
            ->orderBy('tanggal', 'desc')
            ->get();

        // Hitung total kegiatan yang dihadiri
        $total = $riwayat->count();

        return view('user.riwayat.index', compact('riwayat', 'total'));
    }
}
