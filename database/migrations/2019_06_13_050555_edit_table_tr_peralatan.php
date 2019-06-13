<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditTableTrPeralatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tr_peralatan', function(Blueprint $table) {
            $table->dropColumn('nama_barang');
            $table->string('kode_barang')->after('nip');
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
            $table->string('nama_barang')->after('nip');
            $table->dropColumn('kode_barang');
        });
    }
}
