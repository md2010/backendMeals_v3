<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTranslationsTable extends Migration
{
    public function up()
    {
        Schema::create('category_translations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('category_id');
            $table->string('locale')->index();

            //what needs to be translated
            $table->text('title');           
           
            $table->unique(['category_id', 'locale']);
            $table->foreign('category_id')->references('id')->on('categories')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_translations');
    }
}
