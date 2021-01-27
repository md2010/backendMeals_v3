<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealTranslationsTable extends Migration
{
    public function up()
    {
        Schema::create('meal_translations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('meal_id');
            
            //what needs to be translated
            $table->text('title');
            $table->text('description');

            $table->string('locale')->index();
            //foreign key
            $table->unique(['meal_id', 'locale']);
            $table->foreign('meal_id')->references('id')->on('meals')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('meal_translations');
    }
}
