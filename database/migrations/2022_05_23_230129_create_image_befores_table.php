<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageBeforesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_befores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_diagnoses');
            $table->string('path');
            $table->string('keterangan');
            $table->timestamps();
            $table->foreign('id_diagnoses')->references('id')->on('diagnoses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image_befores');
    }
}
