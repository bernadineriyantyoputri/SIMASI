<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Perbaikan auto increment untuk kolom id di tabel kegiatan
        // sudah tidak diperlukan lagi karena sekarang kolom id dibuat
        // dengan $table->id() di migration create_kegiatan_table.
        //
        // Jadi migration ini dibiarkan kosong supaya tidak bentrok
        // dengan foreign key dari tabel absensi.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tidak ada perubahan di up(), jadi tidak perlu rollback apa-apa di sini.
    }
};
