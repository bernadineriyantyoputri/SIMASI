<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('absensi', function (Blueprint $table) {
            // user yang melakukan absensi
            $table->foreignId('user_id')
                ->after('kegiatan_id')
                ->constrained()
                ->onDelete('cascade');

            // jam hadir & bukti foto
            $table->time('jam_hadir')->nullable()->after('tanggal');
            $table->string('bukti_foto')->nullable()->after('jam_hadir');

            // status persetujuan absensi: pending / approved / rejected
            $table->string('approval_status')
                ->default('pending')
                ->after('bukti_foto');
        });
    }

    public function down(): void
    {
        Schema::table('absensi', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'jam_hadir', 'bukti_foto', 'approval_status']);
        });
    }
};
