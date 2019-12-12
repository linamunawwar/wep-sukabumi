<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsSesuaiTableLogTrPermintaanDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_tr_permintaan_detail', function(Blueprint $table) {
            $table->string('is_sesuai')->after('keperluan')->nullable();
            $table->datetime('is_sesuai_at')->after('is_sesuai')->nullable();
        });
        Schema::table('log_tr_penerimaan_detail', function(Blueprint $table) {
            $table->string('keterangan')->after('satuan')->nullable();
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
            $table->dropColumn('is_sesuai');
            $table->dropColumn('is_sesuai_at');
        });
        Schema::table('log_tr_penerimaan_detail', function(Blueprint $table) {
            $table->dropColumn('keterangan');
        });
    }
}
