<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNoKtpNoPkwtPegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mst_pegawai', function(Blueprint $table) {
            $table->string('no_ktp')->after('email');
            $table->string('no_pkwt')->after('no_ktp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mst_pegawai', function(Blueprint $table) {
            $table->dropColumn('no_ktp');
            $table->dropColumn('no_pkwt');
        });
    }
}
