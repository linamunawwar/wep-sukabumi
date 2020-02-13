<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsNotifPenerimaanPengajuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_tr_penerimaan', function(Blueprint $table) {
            $table->string('is_notif')->after('note_pm')->nullable();
        });
        Schema::table('log_tr_pengajuan', function(Blueprint $table) {
            $table->string('is_notif')->after('note_admin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_tr_penerimaan', function(Blueprint $table) {
            $table->dropColumn('is_notif');
        });
        Schema::table('log_tr_pengajuan', function(Blueprint $table) {
            $table->dropColumn('is_notif');
        });
    }
}
