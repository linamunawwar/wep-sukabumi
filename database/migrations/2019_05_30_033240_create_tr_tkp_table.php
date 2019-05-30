<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrTkpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_rkp', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_bagian');
            $table->string('kebutuhan')->nullable();
            $table->string('tersedia')->nullable();
            $table->string('kurang_lebih')->nullable();
            $table->string('mutasi_masuk')->nullable();
            $table->string('mutasi_keluar')->nullable();
            $table->string('mutasi_jumlah')->nullable();
            $table->string('mutasi_rekrut')->nullable();
            $table->string('keterangan')->nullable();
            $table->boolean('soft_delete')->nullable()->default(0);
            $table->string('user_id')->nullable();
            $table->string('role_id')->nullable();
            $table->timestamps();
        });

        Schema::create('tr_detail_rkp', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_rkp');
            $table->string('jabatan')->nullable();
            $table->string('tugas')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('tahun_kerja')->nullable();
            $table->string('jenis_kerja')->nullable();
            $table->string('TPA')->nullable();
            $table->string('EPT')->nullable();
            $table->string('jumlah_kurang')->nullable();
            $table->string('waktu_penempatan')->nullable();
            $table->string('rencana_penempatan')->nullable();
            $table->string('evaluasi')->nullable();
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
        Schema::dropIfExists('tr_rkp');
        Schema::dropIfExists('tr_detail_rkp');
    }
}
