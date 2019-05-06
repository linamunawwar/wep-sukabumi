<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTrSpj extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_spj', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nip');
            $table->date('tanggal_berangkat');
            $table->date('tanggal_pulang');
            $table->string('angkutan');
            $table->string('nominal');
            $table->string('keperluan');
            $table->string('file_surat');

            $table->string('is_verif_sdm')->nullable();
            $table->string('verif_sdm_by')->nullable();
            $table->datetime('verify_sdm_time')->nullable();

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
        Schema::dropIfExists('tr_spj');
    }
}
