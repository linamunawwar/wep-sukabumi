<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTrPeralatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_peralatan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nip');
            $table->string('nama_barang');
            $table->string('tipe_barang')->nullable();
            $table->date('tanggal_pinjam');

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
        Schema::dropIfExists('tr_peralatan');
    }
}
