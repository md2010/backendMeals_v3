<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealTagTable extends Migration
{
    public function up()
    {
        Schema::create('meal_tag', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->bigInteger('meal_id')->unsigned();
            $table->foreign('meal_id')->references('id')->on('meals')
                  ->onDelete('cascade');

            $table->bigInteger('tag_id')->unsigned();
            $table->foreign('tag_id')->references('id')->on('tags')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('meal_tag');
    }
}
