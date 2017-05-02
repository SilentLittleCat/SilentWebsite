<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('director')->nullable();
            $table->string('actors')->nullable();
            $table->string('poster')->nullable();
            $table->string('description')->nullable();
            $table->string('recommend')->nullable();
            $table->integer('ranking')->unsigned()->nullable();
            $table->float('stars', 2, 1)->nullable();
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
        Schema::dropIfExists('movies');
    }
}
