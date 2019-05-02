<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrIzinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_izin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nip');
            $table->string('alasan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('surat')->nullable();

            $table->string('is_verif_mngr')->nullable();
            $table->string('verif_mngr_by')->nullable();
            $table->string('verify_mngr_time')->nullable();

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
        Schema::dropIfExists('tr_izin');
    }
}
