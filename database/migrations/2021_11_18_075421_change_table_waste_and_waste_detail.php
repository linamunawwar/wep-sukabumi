<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTableWasteAndWasteDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_tr_waste', function(Blueprint $table) {
            $table->dropColumn('material_id');
            $table->dropColumn('periode');
            $table->dropColumn('volume_pekerjaan');
            $table->string('bulan')->after('id');
            $table->string('tahun')->after('bulan');
            $table->string('lokasi_id')->after('jenis_pekerjaan_id')->nullable();
            $table->string('progress_pekerjaan')->after('lokasi_id')->nullable();
        });
        Schema::table('log_tr_waste_detail', function(Blueprint $table) {
            $table->dropColumn('lokasi_kerja_id');
            $table->dropColumn('pelaksana');
            $table->dropColumn('progress_vol');
            $table->dropColumn('vol_bahan');
            $table->dropColumn('real_pemakaian');
            $table->dropColumn('waste_vol');
            $table->dropColumn('waste_rencana');
            $table->dropColumn('waste_real');
            $table->dropColumn('waste_deviasi');
            $table->string('material_id')->after('id');
            $table->string('satuan')->after('material_id');
            $table->string('vol_app')->after('satuan')->nullable();
            $table->string('vol_progress')->after('progress_persen')->nullable();
            $table->string('pemakaian')->after('vol_progress')->nullable();
            $table->string('deviasi_vol')->after('pemakaian')->nullable();
            $table->string('deviasi')->after('deviasi_vol')->nullable();
            $table->string('rencana_waste')->after('deviasi')->nullable();
            $table->string('realisasi')->after('rencana_waste')->nullable();
        });
        Schema::dropIfExists('log_tr_waste_pengajuan');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
