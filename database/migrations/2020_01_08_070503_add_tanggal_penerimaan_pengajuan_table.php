<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTanggalPenerimaanPengajuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_tr_penerimaan_detail', function(Blueprint $table) {
            $table->date('tanggal_terima')->after('penerimaan_id')->nullable();
        });
        Schema::table('log_tr_pengajuan_detail', function(Blueprint $table) {
            $table->date('tanggal_pengajuan')->after('pengajuan_id')->nullable();
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
            $table->dropColumn('tanggal_terima');
        });
        Schema::table('log_tr_pengajuan_detail', function(Blueprint $table) {
            $table->dropColumn('tanggal_pengajuan');
        });
    }
}
