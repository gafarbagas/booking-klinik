<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificateRestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificate_rests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_doctor');
            $table->unsignedBigInteger('id_patient');
            $table->string('no_surat');
            $table->string('keterangan');
            $table->string('alasan');
            $table->date('tanggal_mulai_izin');
            $table->date('tanggal_selesai_izin');
            $table->date('tanggal_surat');
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
        Schema::dropIfExists('certificate_rests');
    }
}
