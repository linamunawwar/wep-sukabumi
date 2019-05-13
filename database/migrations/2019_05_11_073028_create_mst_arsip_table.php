<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstArsipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_arsip', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_form');
            $table->string('nama_file');
            $table->string('PM')->nullable();
            $table->string('SO')->nullable();
            $table->string('SC')->nullable();
            $table->string('SA')->nullable();
            $table->string('SE')->nullable();
            $table->string('SL')->nullable();
            $table->string('HS')->nullable();
            $table->string('QC')->nullable();

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
        chema::dropIfExists('mst_arsip');
    }
}
