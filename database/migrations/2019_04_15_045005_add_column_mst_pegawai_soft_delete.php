<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnMstPegawaiSoftDelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::table('mst_pegawai', function(Blueprint $table) {
            $table->string('is_active')->after('is_new')->nullable();
            $table->string('verify_time')->after('verif_by')->nullable();
            $table->string('deleted_at')->after('soft_delete')->nullable();
            $table->string('deleted_by')->after('deleted_at')->nullable();
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
            $table->dropColumn('is_active');
            $table->dropColumn('verify_time');
            $table->dropColumn('deleted_at');
            $table->dropColumn('deleted_by');
        });
    }
}
