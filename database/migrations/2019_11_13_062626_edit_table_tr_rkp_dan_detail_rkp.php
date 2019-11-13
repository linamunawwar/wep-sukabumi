<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditTableTrRkpDanDetailRkp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tr_rkp', function(Blueprint $table) {
            $table->dropColumn('kebutuhan');
            $table->dropColumn('tersedia');
            $table->dropColumn('kurang_lebih');
            $table->dropColumn('mutasi_masuk');
            $table->dropColumn('mutasi_keluar');
            $table->dropColumn('mutasi_jumlah');
            $table->dropColumn('mutasi_rekrut');
            $table->dropColumn('keterangan'); 
            $table->date('tanggal')->after('kode_bagian')->nullable();  
        });
        Schema::table('tr_detail_rkp', function(Blueprint $table) {
            $table->string('unit_kerja')->after('id_rkp')->nullable();
            $table->string('kebutuhan')->after('unit_kerja')->nullable();
            $table->string('tersedia')->after('kebutuhan')->nullable();
            $table->string('kurang_lebih')->after('tersedia')->nullable();
            $table->string('masuk')->after('kurang_lebih')->nullable();
            $table->string('keluar')->after('masuk')->nullable();
            $table->string('jumlah')->after('keluar')->nullable();
            $table->string('rekrut')->after('jumlah')->nullable(); 
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tr_rkp', function(Blueprint $table) {
            $table->string('kebutuhan');
            $table->string('tersedia');
            $table->string('kurang_lebih');
            $table->string('mutasi_masuk');
            $table->string('mutasi_keluar');
            $table->string('mutasi_jumlah');
            $table->string('mutasi_rekrut');
            $table->string('keterangan'); 
            $table->dropColumn('tanggal');  
        });
        Schema::table('tr_detail_rkp', function(Blueprint $table) {
            $table->dropColumn('unit_kerja');
            $table->dropColumn('kebutuhan');
            $table->dropColumn('tersedia');
            $table->dropColumn('kurang_lebih');
            $table->dropColumn('masuk');
            $table->dropColumn('keluar');
            $table->dropColumn('jumlah');
            $table->dropColumn('rekrut'); 
        });
    }
}
