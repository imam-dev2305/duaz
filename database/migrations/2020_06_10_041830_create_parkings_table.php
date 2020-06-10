<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParkingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('parkings');
        Schema::create('parkings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('jns_kendaraan','10');
            $table->char('nopol','10');
            $table->date('tgl_transaksi');
            $table->time('waktu_masuk');
            $table->time('waktu_keluar');
            $table->integer('biaya');
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
        Schema::dropIfExists('parkings');
    }
}
