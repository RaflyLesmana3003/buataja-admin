<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('name')->nullable();
            $table->String('ID_USER');
            $table->String('kreasi')->nullable();
            $table->String('facebook')->nullable();
            $table->String('instagram')->nullable();
            $table->String('twitter')->nullable();
            $table->String('youtube')->nullable();
            $table->integer('nudity')->default(0);
            $table->String('cover')->nullable();
            $table->String('photo')->nullable();
            $table->longText('desc')->nullable();
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
        Schema::dropIfExists('creators');
    }
}
