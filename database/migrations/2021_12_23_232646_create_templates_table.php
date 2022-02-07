<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('template_name');
            $table->string('question_name');
            $table->string('answer');
            $table->enum('typeQ',['text_field','single_choice','multiple_choice']);
           $table->string('status')->default(false);
            
          
            // $table->unsignedBigInteger('question_id');
            // $table->unsignedBigInteger('answer_id');
            // $table->unsignedBigInteger('signature_id');
            // $table->unsignedBigInteger('material_id');
            // $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('signature_id')->references('id')->on('signatures')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('templates');
    }
}