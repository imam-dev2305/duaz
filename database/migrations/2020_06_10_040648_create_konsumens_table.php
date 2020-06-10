<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonsumensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('konsumens');
        Schema::create('konsumens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nm_konsumen','50');
            $table->string('jns_kendaraan','10');
            $table->char('nopol','10');
            $table->date('tgl_lahir');
            $table->char('jns_kelamin','1');
            $table->char('no_hp', 15);
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
        Schema::dropIfExists('konsumens');
    }
}
