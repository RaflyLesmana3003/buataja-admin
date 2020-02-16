<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('ID_CREATOR');
            $table->String('title');
            $table->longText('caption');
            $table->longText('desc')->nullable();
            $table->longText('file_name')->nullable();
            $table->longText('file')->nullable();
            $table->longText('thumbnail')->nullable();
            $table->longText('link')->nullable();
            $table->String('privilage');
            $table->String('tipe');
            $table->integer('like')->nullable();
            $table->integer('view')->default(0);
            $table->integer('comment')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
