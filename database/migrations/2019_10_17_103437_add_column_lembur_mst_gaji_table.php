<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnLemburMstGajiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mst_gaji', function(Blueprint $table) {
            $table->string('uang_lembur')->after('uang_makan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mst_gaji', function(Blueprint $table) {
            $table->dropColumn('uang_lembur');
        });    }
}
