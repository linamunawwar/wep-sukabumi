<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrPengajuanDanTrPengajuanDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_tr_pengajuan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_penerimaan')->nullable();
            $table->date('tanggal');
            $table->string('jenis_pekerjaan_id')->nullable();
            $table->string('lokasi_kerja_id')->nullable();
            $table->string('volume')->nullable();
            $table->string('no_wbs')->nullable();
            $table->string('is_som')->nullable();
            $table->datetime('is_som_at')->nullable();
            $table->text('note_som')->nullable();
            $table->string('is_splem')->nullable();
            $table->datetime('is_splem_at')->nullable();
            $table->text('note_splem')->nullable();
            $table->string('is_admin')->nullable();
            $table->datetime('is_admin_at')->nullable();
            $table->text('note_admin')->nullable();
            $table->string('user_id')->nullable();
            $table->boolean('soft_delete')->nullable()->default(0);
            $table->timestamps();
        });

        Schema::create('log_tr_pengajuan_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pengajuan_id')->nullable();
            $table->string('element_activity')->nullable();
            $table->string('material_id')->nullable();
            $table->string('permintaan_satuan')->nullable();
            $table->string('permintaan_jumlah')->nullable();
            $table->string('penyerahan_satuan')->nullable();
            $table->string('pemyerahan_jumlah')->nullable();
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
        Schema::dropIfExists('log_tr_pengajuan');
        Schema::dropIfExists('log_tr_pengajuan_detail');
    }
}
