<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTanggalPemakaianAtPemakaianLogistik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_tr_permintaan_detail', function (Blueprint $table) {
            $table->date('tgl_pakai')->after('keperluan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_tr_permintaan_detail', function(Blueprint $table) {
            $table->dropColumn('tgl_pakai');
        });
    }
}
