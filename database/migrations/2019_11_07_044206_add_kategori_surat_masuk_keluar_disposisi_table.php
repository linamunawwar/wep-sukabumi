<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKategoriSuratMasukKeluarDisposisiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mst_disposisi', function(Blueprint $table) {
            $table->string('kategori')->after('kepada')->nullable();
        });
        Schema::table('mst_surat_masuk', function(Blueprint $table) {
            $table->string('kategori')->after('kepada')->nullable();
        });
        Schema::table('mst_surat_keluar', function(Blueprint $table) {
            $table->string('kategori')->after('kepada')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mst_disposisi', function(Blueprint $table) {
            $table->dropColumn('kategori');
        });
        Schema::table('mst_surat_masuk', function(Blueprint $table) {
            $table->dropColumn('kategori');
        });
        Schema::table('mst_surat_keluar', function(Blueprint $table) {
            $table->dropColumn('kategori');
        });
    }
}
