<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstPegawaiTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_pegawai', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('nip')->nullable();
            $table->string('email');
            $table->enum('gender',['P','W'])->nullable();
            $table->string('gelar_depan')->nullable();
            $table->string('gelar_belakang')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('alamat_tetap')->nullable();
            $table->string('alamat_sementara')->nullable();
            $table->string('email_kantor')->nullable();
            $table->string('agama')->nullable();
            $table->string('status_kawin')->nullable();
            $table->string('suami_istri')->nullable();
            $table->string('anak')->nullable();
            $table->string('telp')->nullable();
            $table->string('hp')->nullable();
            $table->string('fax')->nullable();
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
        Schema::dropIfExists('mst_pegawai');
    }
}
