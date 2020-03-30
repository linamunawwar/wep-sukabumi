<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DelStatusPenyerahanPermintaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_tr_permintaan', function(Blueprint $table) {
            $table->dropColumn('kode_penyerahan');
            $table->dropColumn('status_penyerahan');
        });
        Schema::table('log_tr_pengajuan', function(Blueprint $table) {
            $table->string('status_konfirmasi')->after('status_penyerahan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_tr_pengajuan', function(Blueprint $table) {
            $table->dropColumn('status_konfirmasi');
        });
    }
}
