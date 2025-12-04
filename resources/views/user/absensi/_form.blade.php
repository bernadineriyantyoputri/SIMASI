<form action="{{ route('user.absensi.store', $kegiatan->id ?? $k->id ?? $k['id']) }}"
      method="POST" enctype="multipart/form-data"
      class="space-y-3">
    @csrf

    <div>
        <label class="block text-sm font-medium mb-1">Tanggal Hadir</label>
        <input type="date" name="tanggal"
               value="{{ old('tanggal', now()->toDateString()) }}"
               class="border rounded px-3 py-2 w-full text-sm">
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Jam Hadir</label>
        <input type="time" name="jam_hadir"
               value="{{ old('jam_hadir') }}"
               class="border rounded px-3 py-2 w-full text-sm">
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Bukti Foto Kehadiran</label>
        <input type="file" name="bukti_foto" accept="image/*"
               class="border rounded px-3 py-2 w-full text-sm">
        <p class="text-xs text-gray-500 mt-1">
            Foto sebelumnya akan diganti jika kamu upload ulang.
        </p>
    </div>

    <button type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700">
        Kirim Absensi
    </button>
</form>
