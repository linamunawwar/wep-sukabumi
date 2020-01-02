<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsAdminPermintaanPenerimaanPengajuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_tr_permintaan', function(Blueprint $table) {
            $table->string('is_admin')->after('tanggal')->nullable();
            $table->datetime('is_admin_at')->after('is_admin')->nullable();
        });
        Schema::table('log_tr_penerimaan', function(Blueprint $table) {
            $table->string('is_admin')->after('tanggal')->nullable();
            $table->datetime('is_admin_at')->after('is_admin')->nullable();
        });
        Schema::table('log_tr_pengajuan', function(Blueprint $table) {
            $table->string('is_pelaksana')->after('tanggal')->nullable();
            $table->datetime('is_pelaksana_at')->after('is_pelaksana')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_tr_permintaan', function(Blueprint $table) {
            $table->dropColumn('is_admin');
            $table->dropColumn('is_admin_at');
        });
        Schema::table('log_tr_penerimaan', function(Blueprint $table) {
            $table->dropColumn('is_admin');
            $table->dropColumn('is_admin_at');
        });
        Schema::table('log_tr_pengajuan', function(Blueprint $table) {
            $table->dropColumn('is_pelaksana');
            $table->dropColumn('is_pelaksana_at');
        });
    }
}
