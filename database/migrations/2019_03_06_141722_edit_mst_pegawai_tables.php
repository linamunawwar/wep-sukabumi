<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditMstPegawaiTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mst_pegawai', function (Blueprint $table) {
            $table->string('is_verif')->after('fax')->nullable();
            $table->string('verif_by')->after('is_verif')->nullable();
            $table->string('is_new')->after('verif_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mst_pegawai', function (Blueprint $table) {
            $table->dropColumn('is_verif');
            $table->dropColumn('verif_by');
            $table->dropColumn('is_new');
        });
    }
}
