<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSisaStokTableTrPenerimaanDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_tr_penerimaan_detail', function(Blueprint $table) {
            $table->string('sisa_stok')->after('vol_sisa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_tr_penerimaan_detail', function(Blueprint $table) {
            $table->dropColumn('sisa_stok');
        });
    }
}
