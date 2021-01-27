<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealsTable extends Migration
{
    public function up()
    {
        Schema::create('meals', function (Blueprint $table) {
            $table->id();           
            //$table->timestamps();   
            //$table->softDeletes(); 
            $table->integer('created_at');
            $table->integer('updated_at');
            $table->integer('deleted_at')->nullable();
            $table->text('status');                 
            $table->integer('category_id')->nullable(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('meals');
    }

}
