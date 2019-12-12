<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKodePermintaanTableLogTrPenerimaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_tr_penerimaan', function(Blueprint $table) {
            $table->string('kode_permintaan')->after('id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_tr_penerimaan', function(Blueprint $table) {
            $table->dropColumn('kode_permintaan');
        });
    }
}
