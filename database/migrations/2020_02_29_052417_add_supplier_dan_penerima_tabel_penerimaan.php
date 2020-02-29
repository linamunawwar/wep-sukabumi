<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSupplierDanPenerimaTabelPenerimaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_tr_penerimaan', function(Blueprint $table) {
            $table->string('supplier')->after('tanggal')->nullable();
            $table->string('penerima')->after('supplier')->nullable();
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
            $table->dropColumn('supplier');
            $table->dropColumn('penerima');
        });
    }
}
