<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMstBankAsuransi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_bank_asuransi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nip');
            $table->string('nama_bank')->nullable();
            $table->string('no_rekening')->nullable();
            $table->string('npwp')->nullable();
            $table->string('jamsostek')->nullable();
            $table->string('dplk')->nullable();
            $table->string('jiwasraya')->nullable();
            $table->string('asuransi_lain')->nullable();
            $table->string('nomor_lain')->nullable();
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
        Schema::dropIfExists('mst_bank_asuransi');
    }
}
