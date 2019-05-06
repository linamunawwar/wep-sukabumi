<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrMemoPegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_memo_pegawai', function (Blueprint $table) {
            $table->increments('id');
            $table->string('memo_id');
            $table->string('pegawai_id');
            $table->datetime('viewed_at');

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
        Schema::dropIfExists('tr_memo_pegawai');
    }
}
