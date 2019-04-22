<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMstPendidikan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_pendidikan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nip');
            $table->string('jenjang')->nullable();
            $table->string('asal_sekolah')->nullable();
            $table->string('kota')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('tahun_lulus')->nullable();
            $table->string('no_ijazah')->nullable();
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
        Schema::dropIfExists('mst_pendidikan');
    }
}
