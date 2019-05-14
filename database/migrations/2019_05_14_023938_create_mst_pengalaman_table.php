<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstPengalamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_pengalaman', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nip');
            $table->string('tanggal_mulai')->nullable();
            $table->string('tanggal_akhir')->nullable();
            $table->string('nama_perusahaan')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('nama_file')->nullable();
            $table->boolean('soft_delete')->nullable()->default(0);
            $table->string('user_id')->nullable();
            $table->string('role_id')->nullable();
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
        Schema::dropIfExists('mst_pengalaman');
    }
}
