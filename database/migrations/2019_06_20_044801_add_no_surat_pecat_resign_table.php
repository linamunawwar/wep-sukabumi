<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNoSuratPecatResignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tr_pecat', function(Blueprint $table) {
            $table->string('no_surat')->after('verify_pm_time');
        });

        Schema::table('tr_resign', function(Blueprint $table) {
            $table->string('no_surat')->after('verify_pm_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tr_pecat', function(Blueprint $table) {
            $table->dropColumn('no_surat')->after('verify_pm_time');
        });

        Schema::table('tr_resign', function(Blueprint $table) {
            $table->dropColumn('no_surat')->after('verify_pm_time');
        });
    }
}
