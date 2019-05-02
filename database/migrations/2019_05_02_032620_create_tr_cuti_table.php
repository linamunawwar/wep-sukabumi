<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrCutiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_cuti', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nip');
            $table->string('alasan');
            $table->text('alamat_cuti');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('pengganti');
            $table->string('is_verif_pengganti')->nullable();
            $table->string('verif_pengganti_by')->nullable();
            $table->string('verify_pengganti_time')->nullable();

            $table->text('ket_manager')->nullable();
            $table->string('is_verif_mngr')->nullable();
            $table->string('verif_mngr_by')->nullable();
            $table->string('verify_mngr_time')->nullable();

            $table->text('ket_sdm')->nullable();
            $table->string('is_verif_sdm')->nullable();
            $table->string('verif_sdm_by')->nullable();
            $table->string('verify_sdm_time')->nullable();

            $table->string('is_accept_pm')->nullable();
            $table->string('is_verif_pm')->nullable();
            $table->string('verif_pm_by')->nullable();
            $table->string('verify_pm_time')->nullable();

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
        Schema::dropIfExists('tr_cuti');
    }
}
