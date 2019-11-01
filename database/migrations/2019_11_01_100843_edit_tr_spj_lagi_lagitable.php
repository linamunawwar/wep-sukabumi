<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditTrSpjLagiLagitable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tr_spj', function(Blueprint $table) {
            $table->dropColumn('uang_akomodasi');
            $table->string('uang_taksi')->after('uang_konsumsi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tr_spj', function(Blueprint $table) {
            $table->dropColumn('uang_taksi');
        });
    }
}
