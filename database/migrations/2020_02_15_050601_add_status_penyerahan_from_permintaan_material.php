<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusPenyerahanFromPermintaanMaterial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_tr_permintaan', function(Blueprint $table) {
            $table->string('catatan_penyerahan')->after('is_notif')->nullable();
            $table->string('status_penyerahan')->after('catatan_penyerahan')->nullable();
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
            $table->dropColumn('catatan_penyerahan');
            $table->dropColumn('status_penyerahan');
        });
    }
}
