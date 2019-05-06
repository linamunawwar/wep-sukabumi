<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrSlipGajiTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_slip_gaji', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nip');
            $table->string('bulan');
            $table->string('tahun');
            $table->text('keperluan');

            $table->string('is_verif_sdm')->nullable();
            $table->string('verif_sdm_by')->nullable();
            $table->string('verify_sdm_time')->nullable();

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
        Schema::dropIfExists('tr_slip_gaji');
    }
}
