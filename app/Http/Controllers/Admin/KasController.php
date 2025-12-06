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
        $request->validate([
            'tanggal'    => 'required|date',
            'jenis'      => 'required|in:pemasukan,pengeluaran',
            'kategori'   => 'required|string|max:100',
            'keterangan' => 'required|string',
            'nominal'    => 'required|integer|min:0',
        ]);

        Kas::create($request->only([
            'tanggal', 'jenis', 'kategori', 'keterangan', 'nominal'
        ]));

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

        $request->validate([
            'tanggal'    => 'required|date',
            'jenis'      => 'required|in:pemasukan,pengeluaran',
            'kategori'   => 'required|string|max:100',
            'keterangan' => 'required|string',
            'nominal'    => 'required|integer|min:0',
        ]);

        $kas->update($request->only([
            'tanggal', 'jenis', 'kategori', 'keterangan', 'nominal'
        ]));

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
