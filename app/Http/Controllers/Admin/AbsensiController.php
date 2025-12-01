<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absensi;

class AbsensiController extends Controller
{
    public function index()
    {
        $absensi = Absensi::all(); // nanti bisa diganti pagination
        return view('admin.absensi.index', compact('absensi'));
    }

    public function create()
    {
        return view('admin.absensi.create');
    }

    public function edit($id)
    {
        $absensi = Absensi::findOrFail($id);
        return view('admin.absensi.edit', compact('absensi'));
    }

    public function store(Request $request)
    {
        // validasi dan simpan
    }

    public function update(Request $request, $id)
    {
        // validasi dan update
    }

    public function destroy($id)
    {
        Absensi::destroy($id);
        return redirect()->route('admin.absensi.index');
    }
}
