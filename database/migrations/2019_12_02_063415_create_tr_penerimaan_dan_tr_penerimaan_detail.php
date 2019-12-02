<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrPenerimaanDanTrPenerimaanDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_tr_penerimaan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_penerimaan')->nullable();
            $table->date('tanggal');
            $table->string('is_splem')->nullable();
            $table->datetime('is_splem_at')->nullable();
            $table->text('note_splem')->nullable();
            $table->string('user_id')->nullable();
            $table->boolean('soft_delete')->nullable()->default(0);
            $table->timestamps();
        });

        Schema::create('log_tr_penerimaan_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->string('penerimaan_id')->nullable();
            $table->string('material_id')->nullable();
            $table->string('part_type')->nullable();
            $table->string('harga')->nullable();
            $table->string('volume')->nullable();
            $table->string('satuan')->nullable();
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
        Schema::dropIfExists('log_tr_penerimaan');
        Schema::dropIfExists('log_tr_penerimaan_detail');
    }
}
