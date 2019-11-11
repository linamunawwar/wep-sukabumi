<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsVerifPmTrRkpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tr_rkp', function(Blueprint $table) {
            $table->string('is_verif_pm')->after('keterangan')->nullable();
            $table->string('verif_pm_by')->after('is_verif_pm')->nullable();
            $table->datetime('verify_pm_time')->after('verif_pm_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tr_rkp', function(Blueprint $table) {
            $table->dropColumn('is_verif_pm');
            $table->dropColumn('verif_pm_by');
            $table->dropColumn('verify_pm_time');
        });
    }
}
