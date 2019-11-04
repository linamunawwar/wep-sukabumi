<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVerifSdmTrIzinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tr_izin', function(Blueprint $table) {
            $table->string('is_verif_sdm')->after('verify_mngr_time')->nullable();
            $table->string('verif_sdm_by')->after('is_verif_sdm')->nullable();
            $table->datetime('verify_sdm_time')->after('verif_sdm_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tr_spj', function(Blueprint $table) {
            $table->dropColumn('is_verif_sdm');
            $table->dropColumn('verif_sdm_by');
            $table->dropColumn('verify_sdm_time');
        });
    }
}
