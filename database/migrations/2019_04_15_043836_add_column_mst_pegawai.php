<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnMstPegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mst_pegawai', function(Blueprint $table) {
            $table->string('kerja_suami_istri')->after('suami_istri')->nullable();
            $table->string('nama_keluarga')->after('fax')->nullable();
            $table->string('hub_keluarga')->after('nama_keluarga')->nullable();
            $table->string('alamat_keluarga')->after('hub_keluarga')->nullable();
            $table->string('telp_keluarga')->after('alamat_keluarga')->nullable();
            $table->string('tanggal_masuk')->after('telp_keluarga')->nullable();
            $table->string('tanggal_masuk_pt')->after('tanggal_masuk')->nullable();
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
            $table->dropColumn('email');
            $table->dropColumn('kerja_suami_istri');
            $table->dropColumn('nama_keluarga');
            $table->dropColumn('hub_keluarga');
            $table->dropColumn('alamat_keluarga');
            $table->dropColumn('tanggal_masuk');
            $table->dropColumn('tanggal_masuk_pt');
        });
    }
}
