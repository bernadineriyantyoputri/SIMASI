<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('peserta_kegiatan', function (Blueprint $table) {
            $table->string('status')
                  ->default('pending')
                  ->after('kegiatan_id'); // sesuaikan kalau urutan beda
        });
    }

    public function down(): void
    {
        Schema::table('peserta_kegiatan', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
