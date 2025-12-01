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
    Schema::table('kegiatan', function (Blueprint $table) {
        $table->dropColumn('id');
    });

    Schema::table('kegiatan', function (Blueprint $table) {
        $table->bigIncrements('id')->first();
    });
}

public function down()
{
    Schema::table('kegiatan', function (Blueprint $table) {
        $table->dropColumn('id');
        $table->integer('id');
    });
}

};
