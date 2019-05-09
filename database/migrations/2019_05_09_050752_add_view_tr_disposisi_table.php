<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddViewTrDisposisiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_surat_keluar', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_surat');
            $table->string('pengirim');
            $table->string('kepada');
            $table->date('tanggal_surat');
            $table->string('perihal');
            $table->string('file_surat');

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
        Schema::dropIfExists('mst_surat_keluar');
    }
}
