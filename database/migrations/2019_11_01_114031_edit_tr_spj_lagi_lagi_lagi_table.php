<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditTrSpjLagiLagiLagiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tr_spj', function(Blueprint $table) {
            $table->string('uang_penginapan')->after('angkutan')->nullable();
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
            $table->dropColumn('uang_penginapan');
        });
    }
}
