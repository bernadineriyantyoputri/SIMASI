<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('absensi', function (Blueprint $table) {
        $table->unsignedBigInteger('kegiatan_id')->after('user_id');

        // relasi (optional)
        $table->foreign('kegiatan_id')->references('id')->on('kegiatan')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('absensi', function (Blueprint $table) {
        $table->dropForeign(['kegiatan_id']);
        $table->dropColumn('kegiatan_id');
    });
}

};
