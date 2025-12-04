<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    // ============================
    // LIST SEMUA ABSENSI USER
    // ============================
    public function index()
    {
        $absensi = Absensi::with(['user', 'kegiatan'])
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam_hadir', 'desc')
            ->get();

        return view('admin.absensi.index', compact('absensi'));
    }

    // ============================
    // ADMIN APPROVE / REJECT ABSENSI
    // ============================
    public function update(Request $request, $id)
    {
        $request->validate([
            'aksi' => ['required', 'in:approve,reject'],
        ]);

        $absensi = Absensi::findOrFail($id);

        // Hanya boleh diubah kalau status sekarang masih pending
        if ($absensi->approval_status !== 'pending') {
            return back()->with(
                'error',
                'Status absensi sudah final dan tidak dapat diubah lagi. ' .
                'User harus mengirim absensi ulang jika ingin diperiksa kembali.'
            );
        }

        // Pada titik ini status = pending → boleh approve / reject
        $absensi->approval_status = $request->aksi === 'approve'
            ? 'approved'
            : 'rejected';

        $absensi->save();

        return back()->with('success', 'Status absensi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Absensi::destroy($id);
        return redirect()->route('admin.absensi.index');
    }
}
