<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditTableDetailPenerimaanSemuaKolomVol extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_tr_penerimaan_detail', function(Blueprint $table) {
            $table->dropColumn('part_type');
            $table->dropColumn('volume');
            $table->string('vol_lalu')->after('material_id')->nullable();
            $table->string('vol_saat_ini')->after('vol_lalu')->nullable();
            $table->string('vol_jumlah')->after('vol_saat_ini')->nullable();
            $table->string('vol_sisa')->after('vol_jumlah')->nullable();
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
            $table->string('part_type')->after('material_id')->nullable();
            $table->string('volume')->after('harga')->nullable();
            $table->dropColumn('vol_lalu');
            $table->dropColumn('vol_saat_ini');
            $table->dropColumn('vol_jumlah');
            $table->dropColumn('vol_sisa');
        });
    }
}
