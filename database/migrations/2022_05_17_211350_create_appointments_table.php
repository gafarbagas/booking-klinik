<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_doctor');
            $table->unsignedBigInteger('id_patient');
            $table->unsignedBigInteger('id_service_type');
            $table->enum('status',['menunggu','diterima','ditolak','selesai']);
            $table->enum('status_diagnosis',['belum diagnosis','sudah diagnosis'])->default('belum diagnosis');
            $table->string('no_janji');
            $table->date('tanggal_periksa');
            $table->time('waktu');
            $table->string('keluhan');
            $table->softDeletes();
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
        Schema::dropIfExists('appointments');
    }
}
