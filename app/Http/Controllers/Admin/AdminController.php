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
        $totalUsers    = User::count();
        $totalKegiatan = Kegiatan::count();
        $totalAbsensi  = Absensi::count();

        // Hitung rate absensi sederhana: berapa rasio data absensi terhadap jumlah kegiatan
        $absensiRate = 0;
        if ($totalKegiatan > 0) {
            $absensiRate = round(($totalAbsensi / $totalKegiatan) * 100, 2);
        }

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalKegiatan',
            'absensiRate'
        ));
    }
}
