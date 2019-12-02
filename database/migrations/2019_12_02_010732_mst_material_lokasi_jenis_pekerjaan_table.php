<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MstMaterialLokasiJenisPekerjaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_mst_material', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_material');
            $table->string('nama');
            $table->string('keterangan')->nullable();
            $table->string('user_id')->nullable();
            $table->boolean('soft_delete')->nullable()->default(0);
            $table->timestamps();
        });
        Schema::create('log_mst_lokasi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('keterangan')->nullable();
            $table->string('user_id')->nullable();
            $table->boolean('soft_delete')->nullable()->default(0);
            $table->timestamps();
        });
        Schema::create('log_mst_jenis_pekerjaan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('keterangan')->nullable();
            $table->string('user_id')->nullable();
            $table->boolean('soft_delete')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_mst_material');
        Schema::dropIfExists('log_mst_lokasi');
        Schema::dropIfExists('log_mst_jenis_pekerjaan');
    }
}
