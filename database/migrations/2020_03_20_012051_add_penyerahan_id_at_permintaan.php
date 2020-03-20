<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPenyerahanIdAtPermintaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_tr_permintaan', function(Blueprint $table) {
            $table->string('kode_penyerahan')->after('kode_permintaan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_tr_permintaan', function(Blueprint $table) {
            $table->dropColumn('kode_penyerahan');
        });
    }
}
