<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('kegiatan', function (Blueprint $table) {
            $table->string('lokasi')->nullable()->after('tanggal');
            $table->string('gambar')->nullable()->after('lokasi');
            $table->integer('kuota')->nullable()->after('gambar');
        });
    }

    public function down()
    {
        Schema::table('kegiatan', function (Blueprint $table) {
            $table->dropColumn(['lokasi', 'gambar', 'kuota']);
        });
    }
};
