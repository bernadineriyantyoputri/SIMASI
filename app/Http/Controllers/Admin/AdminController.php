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
        // Total user
        $totalUsers = User::count();

        // Total kegiatan
        $totalKegiatan = Kegiatan::count();

        // Absensi rate (contoh: rata-rata persentase hadir semua kegiatan)
        $absensiRate = 0;
        $totalAbsensi = Absensi::count();
        $totalPeserta = Absensi::sum('jumlah_peserta'); // misal kolom jumlah_peserta ada
        if ($totalPeserta > 0) {
            $absensiRate = round(($totalAbsensi / $totalPeserta) * 100, 2);
        }

        // Ambil daftar kegiatan terbaru, misal 5 terakhir
        $kegiatan = Kegiatan::orderBy('tanggal', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('totalUsers', 'totalKegiatan', 'absensiRate', 'kegiatan'));
    }
}
