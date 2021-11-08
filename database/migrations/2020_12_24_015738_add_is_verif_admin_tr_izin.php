<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsVerifAdminTrIzin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tr_izin', function(Blueprint $table) {
            $table->string('is_verif_admin')->after('surat')->nullable();
            $table->string('verif_admin_by')->after('is_verif_admin')->nullable();
            $table->datetime('verify_admin_time')->after('verif_admin_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tr_izin', function(Blueprint $table) {
            $table->dropColumn('is_verif_admin');
            $table->dropColumn('verif_admin_by');
            $table->dropColumn('verify_admin_time');
        });
    }
}
