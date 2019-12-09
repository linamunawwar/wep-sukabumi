<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableWasteMaterial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('log_tr_waste', function (Blueprint $table) {
            $table->increments('id');
            $table->string('material_id')->nullable();
            $table->string('bulan')->nullable();
            $table->string('tahun')->nullable();
            $table->string('jenis_pekerjaan_id')->nullable();
            $table->string('volume_pekerjaan')->nullable();
            $table->string('user_id')->nullable();
            $table->boolean('soft_delete')->nullable()->default(0);
            $table->timestamps();
        });

        Schema::create('log_tr_waste_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->string('waste_id')->nullable();
            $table->string('lokasi_kerja_id')->nullable();
            $table->string('pelaksana')->nullable();
            $table->string('progress_persen')->nullable();
            $table->string('progress_vol')->nullable();
            $table->string('vol_bahan')->nullable();
            $table->string('real_pemakaian')->nullable();
            $table->string('waste_vol')->nullable();
            $table->string('waste_rencana')->nullable();
            $table->string('waste_real')->nullable();
            $table->string('waste_deviasi')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('user_id')->nullable();
            $table->boolean('soft_delete')->nullable()->default(0);
            $table->timestamps();
        });

        Schema::create('log_tr_waste_pengajuan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('waste_id')->nullable();
            $table->string('is_splem')->nullable();
            $table->datetime('is_splem_at')->nullable();
            $table->text('note_splem')->nullable();
            $table->string('is_sem')->nullable();
            $table->datetime('is_sem_at')->nullable();
            $table->text('note_sem')->nullable();
            $table->string('is_scarm')->nullable();
            $table->datetime('is_scarm_at')->nullable();
            $table->text('note_scarm')->nullable();
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
        Schema::dropIfExists('log_tr_waste');
        Schema::dropIfExists('log_tr_waste_detail');
        Schema::dropIfExists('log_tr_waste_pengajuan');
    }
}
