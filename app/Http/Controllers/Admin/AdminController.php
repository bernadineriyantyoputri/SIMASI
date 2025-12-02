<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kegiatan;
use App\Models\Absensi;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalKegiatan = Kegiatan::count();

        $absensiRate = 0;
        $totalAbsensi = Absensi::count();
        $totalPeserta = Absensi::sum('jumlah_peserta');
        if ($totalPeserta > 0) {
            $absensiRate = round(($totalAbsensi / $totalPeserta) * 100, 2);
        }

        // PERBAIKAN DI SINI
        $kegiatan = Kegiatan::withCount('peserta')
            ->orderBy('tanggal', 'desc')
            ->get();


        return view('admin.kegiatan.index', compact(
            'totalUsers',
            'totalKegiatan',
            'absensiRate',
            'kegiatan'
        ));
    }
}
