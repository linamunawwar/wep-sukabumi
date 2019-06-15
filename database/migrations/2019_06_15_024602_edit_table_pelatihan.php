<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditTablePelatihan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mst_pelatihan', function(Blueprint $table) {
            $table->dropColumn('tanggal');
            $table->date('tanggal_mulai')->after('nip');
            $table->date('tanggal_selesai')->after('tanggal_mulai');
            $table->string('no_im')->after('penyelenggara');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mst_pelatihan', function(Blueprint $table) {
            $table->date('tanggal');
            $table->dropColumn('tanggal_mulai')->after('nip');
            $table->dropColumn('tanggal_selesai')->after('tanggal_mulai');
            $table->dropColumn('no_im')->after('penyelenggara');
        });
    }
}
