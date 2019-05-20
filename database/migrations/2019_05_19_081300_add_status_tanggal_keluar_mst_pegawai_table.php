<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusTanggalKeluarMstPegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mst_pegawai', function(Blueprint $table) {
            $table->date('tanggal_keluar')->after('tanggal_masuk_pt')->nullable();
            $table->string('status_pegawai')->after('tanggal_keluar')->nullable();
            $table->string('pendidikan_terakhir')->after('fax')->nullable();
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
            $table->dropColumn('tanggal_keluar');
            $table->dropColumn('status_pegawai');
            $table->dropColumn('pendidikan_terakhir');
        });
    }
}
