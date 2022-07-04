<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_letters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_doctor');
            $table->unsignedBigInteger('id_patient');
            $table->string('tujuan_dokter');
            $table->string('tujuan_lokasi');
            $table->text('keluhan');
            $table->text('diagnosis_sementara');
            $table->text('tindakan');
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('id_doctor')->references('id')->on('doctors');
            $table->foreign('id_patient')->references('id')->on('patients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referral_letters');
    }
}
