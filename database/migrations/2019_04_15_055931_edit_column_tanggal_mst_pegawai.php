<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditColumnTanggalMstPegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mst_pegawai', function(Blueprint $table) {
            $table->dropColumn('tanggal_masuk');
            $table->dropColumn('tanggal_masuk_pt');
        });

        Schema::table('mst_pegawai', function(Blueprint $table) {
            $table->date('tanggal_masuk')->after('telp_keluarga')->nullable();
            $table->date('tanggal_masuk_pt')->after('tanggal_masuk')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
