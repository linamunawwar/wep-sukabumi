<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstPelatihanCvTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mst_pelatihan', function(Blueprint $table) {
            $table->dropColumn('jam_hari');
            $table->dropColumn('nama_file');
        });

        Schema::create('mst_pelatihan_cv', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nip');
            $table->string('tanggal')->nullable();
            $table->string('nama_pelatihan')->nullable();
            $table->string('tempat')->nullable();
            $table->string('jam_hari')->nullable();
            $table->string('penyelenggara')->nullable();
            $table->string('nama_file')->nullable();
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
        Schema::table('mst_pelatihan', function(Blueprint $table) {
            $table->string('jam_hari');
            $table->string('nama_file');
        });

        Schema::dropIfExists('mst_pelatihan_cv');
    }
}
