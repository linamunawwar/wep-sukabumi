<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCatatanDanStatusFromPengajuanMaterial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_tr_pengajuan', function(Blueprint $table) {
            $table->string('status_penyerahan')->after('is_notif')->nullable();
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
            $table->dropColumn('status_penyerahan');
        });
    }
}
