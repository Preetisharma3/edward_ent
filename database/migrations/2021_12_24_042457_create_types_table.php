<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
             $table->bigIncrements('id');
              $table->enum('question_type', ['Text_Field', 'Single_Choice','Multiple_Choice']);
             $table->unsignedBigInteger('type_id');
              $table->foreign('type_id')->references('id')->on('questions')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('types');
    }
}
