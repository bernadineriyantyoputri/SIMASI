<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kas;
use Illuminate\Http\Request;

class KasController extends Controller
{
    public function index()
    {
        $kas = Kas::orderBy('tanggal', 'asc')->get();

        $total_pemasukan   = Kas::where('jenis', 'pemasukan')->sum('nominal');
        $total_pengeluaran = Kas::where('jenis', 'pengeluaran')->sum('nominal');
        $saldo             = $total_pemasukan - $total_pengeluaran;

        return view('admin.kas.index', compact(
            'kas', 'total_pemasukan', 'total_pengeluaran', 'saldo'
        ));
    }

    public function create()
    {
        return view('admin.kas.create');
    }

    public function store(Request $request)
    {
        // 1. VALIDASI INPUT (nominal jadi string dulu)
        $request->validate([
            'tanggal'    => 'required|date',
            'jenis'      => 'required|in:pemasukan,pengeluaran',
            'kategori'   => 'required|string|max:100',
            'keterangan' => 'required|string',
            'nominal'    => 'required',   // jangan integer di sini
        ]);

        // 2. BERSIHKAN NOMINAL: buang titik, koma, spasi, dll → ambil hanya angka
        $rawNominal = $request->nominal;
        $cleanNominal = preg_replace('/[^0-9]/', '', (string) $rawNominal);

        if ($cleanNominal === '' || !ctype_digit($cleanNominal)) {
            return back()
                ->withErrors(['nominal' => 'Nominal tidak valid.'])
                ->withInput();
        }

        $nominalInt = (int) $cleanNominal;

        // 3. SIMPAN KE DATABASE
        Kas::create([
            'tanggal'    => $request->tanggal,
            'jenis'      => $request->jenis,
            'kategori'   => $request->kategori,
            'keterangan' => $request->keterangan,
            'nominal'    => $nominalInt,
        ]);

        return redirect()->route('admin.kas.index')
                         ->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kas = Kas::findOrFail($id);
        return view('admin.kas.edit', compact('kas'));
    }

    public function update(Request $request, $id)
    {
        $kas = Kas::findOrFail($id);

        // 1. VALIDASI
        $request->validate([
            'tanggal'    => 'required|date',
            'jenis'      => 'required|in:pemasukan,pengeluaran',
            'kategori'   => 'required|string|max:100',
            'keterangan' => 'required|string',
            'nominal'    => 'required',
        ]);

        // 2. BERSIHKAN NOMINAL
        $rawNominal = $request->nominal;
        $cleanNominal = preg_replace('/[^0-9]/', '', (string) $rawNominal);

        if ($cleanNominal === '' || !ctype_digit($cleanNominal)) {
            return back()
                ->withErrors(['nominal' => 'Nominal tidak valid.'])
                ->withInput();
        }

        $nominalInt = (int) $cleanNominal;

        // 3. UPDATE DATA
        $kas->update([
            'tanggal'    => $request->tanggal,
            'jenis'      => $request->jenis,
            'kategori'   => $request->kategori,
            'keterangan' => $request->keterangan,
            'nominal'    => $nominalInt,
        ]);

        return redirect()->route('admin.kas.index')
                         ->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        Kas::findOrFail($id)->delete();

        return redirect()->route('admin.kas.index')
                         ->with('success', 'Data berhasil dihapus');
    }
}
