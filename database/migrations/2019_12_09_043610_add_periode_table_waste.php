<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPeriodeTableWaste extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_tr_waste', function(Blueprint $table) {
            $table->dropColumn('bulan');
            $table->dropColumn('tahun');
            $table->string('periode')->after('material_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_tr_waste', function(Blueprint $table) {
            $table->string('bulan')->nullable();
            $table->string('tahun')->nullable();
            $table->dropColumn('periode');
        });
    }
}
