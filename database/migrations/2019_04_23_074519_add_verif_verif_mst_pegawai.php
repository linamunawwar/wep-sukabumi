<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVerifVerifMstPegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mst_pegawai', function(Blueprint $table) {
            $table->dropColumn('is_verif');
            $table->dropColumn('verif_by');
            $table->string('is_verif_admin')->after('fax')->nullable();
            $table->string('verif_admin_by')->after('is_verif_admin')->nullable();
            $table->string('verify_admin_time')->after('verif_admin_by')->nullable();

            $table->string('is_verif_mngr')->after('verify_admin_time')->nullable();
            $table->string('verif_mngr_by')->after('is_verif_mngr')->nullable();
            $table->string('verify_mngr_time')->after('verif_mngr_by')->nullable();

            $table->string('is_verif_pm')->after('verify_mngr_time')->nullable();
            $table->string('verif_pm_by')->after('is_verif_pm')->nullable();
            $table->string('verify_pm_time')->after('verif_pm_by')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mst_pegawai', function(Blueprint $table) {
            $table->dropColumn('is_verif_admin');
            $table->dropColumn('verif_admin_by');
            $table->dropColumn('verify_admin_time');

            $table->dropColumn('is_verif_mngr');
            $table->dropColumn('verif_mngr_by');
            $table->dropColumn('verify_mngr_time');

            $table->dropColumn('is_verif_pm');
            $table->dropColumn('verif_pm_by');
            $table->dropColumn('verify_pm_time');
            
        });
    }
}
