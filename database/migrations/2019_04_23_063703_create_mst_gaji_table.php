<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstGajiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_gaji', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nip');
            $table->string('gaji_pokok')->nullable();
            $table->string('tunj_komunikasi')->nullable();
            $table->string('tunj_transportasi')->nullable();
            $table->string('uang_makan')->nullable();
            $table->string('tunj_pph21')->nullable();
            $table->string('pph21')->nullable();
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
        Schema::dropIfExists('mst_gaji');
    }
}
