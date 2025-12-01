<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KasController extends Controller
{
    // Tampilkan daftar kas (kosong dulu)
    public function index()
    {
        return view('admin.kas.index'); // view kosong placeholder
    }

    // Halaman buat kas baru (kosong)
    public function create()
    {
        return view('admin.kas.create'); // nanti dibuat view create.blade.php
    }

    // Simpan kas baru (belum dipakai)
    public function store(Request $request)
    {
        // kosong dulu
        return redirect()->route('admin.kas.index');
    }

    // Halaman edit kas (kosong)
    public function edit($id)
    {
        return view('admin.kas.edit', compact('id')); // view edit.blade.php
    }

    // Update kas (belum dipakai)
    public function update(Request $request, $id)
    {
        // kosong dulu
        return redirect()->route('admin.kas.index');
    }

    // Hapus kas (belum dipakai)
    public function destroy($id)
    {
        // kosong dulu
        return redirect()->route('admin.kas.index');
    }
}
