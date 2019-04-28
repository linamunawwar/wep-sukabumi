<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrResignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_resign', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nip');
            $table->text('alasan');
            $table->date('terakhir_kerja');
            $table->string('file_surat')->nullable();

            $table->string('is_verif_mngr')->nullable();
            $table->string('verif_mngr_by')->nullable();
            $table->string('verify_mngr_time')->nullable();

            $table->string('is_verif_sdm')->nullable();
            $table->string('verif_sdm_by')->nullable();
            $table->string('verify_sdm_time')->nullable();

            $table->string('is_verif_pm')->nullable();
            $table->string('verif_pm_by')->nullable();
            $table->string('verify_pm_time')->nullable();

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
        Schema::dropIfExists('tr_resign');
    }
}
