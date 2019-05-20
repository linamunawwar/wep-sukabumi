<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTanggalTerakhirCutiTrCutiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tr_cuti', function(Blueprint $table) {
            $table->date('tanggal_mulai_terakhir')->after('tanggal_selesai')->nullable();
            $table->date('tanggal_selesai_terakhir')->after('tanggal_mulai_terakhir')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tr_cuti', function(Blueprint $table) {
            $table->dropColumn('tanggal_mulai_terakhir');
            $table->dropColumn('tanggal_selesai_terakhir');
        });
    }
}
