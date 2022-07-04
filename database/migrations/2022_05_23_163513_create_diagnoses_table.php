<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnoses', function (Blueprint $table) {
            $table->id();
            $table->string('no_rm');
            $table->unsignedBigInteger('id_doctor');
            $table->unsignedBigInteger('id_patient');
            $table->unsignedBigInteger('id_service_type');
            $table->string('hasil_pemeriksaan');
            $table->string('diagnosis');
            $table->string('tindakan');
            $table->string('rencana');
            $table->string('keluhan');
            $table->date('tanggal');
            $table->timestamps();

            $table->foreign('id_doctor')->references('id')->on('doctors');
            $table->foreign('id_patient')->references('id')->on('patients');
            $table->foreign('id_service_type')->references('id')->on('service_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diagnoses');
    }
}
