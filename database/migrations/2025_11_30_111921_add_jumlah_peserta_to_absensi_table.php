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
        // Kolom jumlah_peserta sekarang sudah dibuat di create_absensi_table,
        // jadi migration ini tidak perlu melakukan apa-apa.
        // Schema::table('absensi', function (Blueprint $table) {
        //     $table->integer('jumlah_peserta')->default(0);
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Karena kolom ini tidak ditambahkan di up(), tidak perlu di-drop di sini.
        // Schema::table('absensi', function (Blueprint $table) {
        //     $table->dropColumn('jumlah_peserta');
        // });
    }
};
