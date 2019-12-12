<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsPmPenerimaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_tr_penerimaan', function(Blueprint $table) {
            $table->string('is_pm')->after('note_splem')->nullable();
            $table->datetime('is_pm_at')->after('is_pm')->nullable();
            $table->text('note_pm')->after('is_pm_at')->nullable();
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
            $table->dropColumn('is_pm');
            $table->dropColumn('is_pm_at');
            $table->dropColumn('note_pm');
        });
    }
}
