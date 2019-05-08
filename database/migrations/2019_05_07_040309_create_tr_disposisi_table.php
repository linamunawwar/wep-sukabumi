<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrDisposisiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_disposisi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_agenda');
            $table->string('pengirim');
            $table->string('kepada');
            $table->date('tanggal_terima');
            $table->string('no_surat');
            $table->date('tanggal_surat');
            $table->string('perihal');
            $table->string('sifat');
            $table->text('note')->nullable();

            $table->string('PM')->nullable();
            $table->string('SOM')->nullable();
            $table->string('SPLEM')->nullable();
            $table->string('QC')->nullable();
            $table->string('SEM')->nullable();
            $table->string('SCARM')->nullable();
            $table->string('SAM')->nullable();
            $table->string('HSE')->nullable();
            $table->string('public_relation')->nullable();

            $table->boolean('soft_delete')->nullable()->default(0);
            $table->string('user_id')->nullable();
            $table->string('role_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_disposisi');
    }
}
