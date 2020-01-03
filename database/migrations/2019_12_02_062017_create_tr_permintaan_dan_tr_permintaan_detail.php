<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrPermintaanDanTrPermintaanDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_tr_permintaan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_permintaan')->nullable();
            $table->date('tanggal');
            $table->string('is_som')->nullable();
            $table->datetime('is_som_at')->nullable();
            $table->text('note_som')->nullable();
            $table->string('is_slem')->nullable();
            $table->datetime('is_slem_at')->nullable();
            $table->text('note_slem')->nullable();
            $table->string('is_scarm')->nullable();
            $table->datetime('is_scarm_at')->nullable();
            $table->text('note_scarm')->nullable();
            $table->string('is_pm')->nullable();
            $table->datetime('is_pm_at')->nullable();
            $table->text('note_pm')->nullable();
            $table->string('is_datang')->nullable();
            $table->datetime('is_datang_at')->nullable();
            $table->string('is_sesuai')->nullable();
            $table->datetime('is_sesuai_at')->nullable();
            $table->string('user_id')->nullable();
            $table->boolean('soft_delete')->nullable()->default(0);
            $table->timestamps();
        });

        Schema::create('log_tr_permintaan_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->string('permintaan_id')->nullable();
            $table->string('material_id')->nullable();
            $table->string('no_part')->nullable();
            $table->string('volume')->nullable();
            $table->string('satuan')->nullable();
            $table->string('keperluan')->nullable();
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
        Schema::dropIfExists('log_tr_permintaan');
        Schema::dropIfExists('log_tr_permintaan_detail');
    }
}
