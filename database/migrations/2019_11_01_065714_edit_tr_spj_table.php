<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditTrSpjTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tr_spj', function(Blueprint $table) {
            $table->dropColumn('nominal');
            $table->string('uang_transport')->after('angkutan')->nullable();
            $table->string('uang_konsumsi')->after('uang_transport')->nullable();
            $table->string('uang_akomodasi')->after('uang_konsumsi')->nullable();
            $table->string('is_verif_admin')->after('file_surat')->nullable();
            $table->string('verif_admin_by')->after('is_verif_admin')->nullable();
            $table->datetime('verify_admin_time')->after('is_verif_admin')->nullable();
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
            $table->dropColumn('uang_transport');
            $table->dropColumn('uang_konsumsi');
            $table->dropColumn('uang_akomodasi');
            $table->dropColumn('is_verif_admin');
            $table->dropColumn('verif_admin_by');
            $table->dropColumn('verify_admin_time');
        });
    }
}
