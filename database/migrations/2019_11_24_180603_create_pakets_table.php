<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paket', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('ID_CREATOR');
            $table->String('nama_paket');
            $table->longText('desc');
            $table->String('harga');
            $table->String('limitasi');
            $table->String('jumlah_limitasi')->nullable();
            $table->longText('benefit')->nullable();
            $table->integer('alamat')->nullable();
            $table->String('photo')->nullable();
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
        Schema::dropIfExists('pakets');
    }
}
