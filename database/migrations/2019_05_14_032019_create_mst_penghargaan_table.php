<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstPenghargaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_penghargaan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nip');
            $table->string('tanggal')->nullable();
            $table->string('nama_penghargaan')->nullable();
            $table->string('tempat')->nullable();
            $table->string('jenis_penghargaan')->nullable();
            $table->string('lingkup_kegiatan')->nullable();
            $table->string('referensi')->nullable();
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
        Schema::dropIfExists('mst_penghargaan');
    }
}
