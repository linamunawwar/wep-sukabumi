<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_menu', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_parent');
            $table->integer('urutan');
            $table->string('nama','50');
            $table->string('alias','50');
            $table->string('direktori','50');
            $table->string('icon','50');
            $table->integer('active');
            $table->string('default_role','50');
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
        Schema::dropIfExists('mst_menu');
    }
}
