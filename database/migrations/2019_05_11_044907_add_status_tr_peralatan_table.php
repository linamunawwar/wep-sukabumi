<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusTrPeralatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tr_peralatan', function(Blueprint $table) {
            $table->string('is_kembali')->after('tanggal_pinjam');
            $table->date('tanggal_kembali')->after('is_kembali');
            $table->string('is_verif_sdm')->after('tanggal_kembali');
            $table->datetime('verif_sdm_at')->after('is_verif_sdm');
            $table->datetime('verify_sdm_by')->after('verif_sdm_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tr_peralatan', function(Blueprint $table) {
            $table->dropColumn('is_kembali');
            $table->dropColumn('tanggal_kembali');
            $table->dropColumn('is_verif_sdm');
            $table->dropColumn('verif_sdm_at');
            $table->dropColumn('verify_sdm_by');
        });
    }
}
