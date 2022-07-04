<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use HasFactory;

    protected $fillable = ['no_rm','id_doctor','id_patient','id_service_type','hasil_pemeriksaan','diagnosis','tindakan','rencana','keluhan','tanggal'];

    public function imageBefore()
    {
        return $this->hasMany(ImageBefore::class, 'id_diagnoses');
    }

    public function imageAfter()
    {
        return $this->hasMany(ImageAfter::class, 'id_diagnoses');
    }

    public function imageLab()
    {
        return $this->hasMany(ImageLab::class, 'id_diagnoses');
    }

    public function imageRadiology()
    {
        return $this->hasMany(ImageRadiology::class, 'id_diagnoses');
    }

    public function prescription()
    {
        return $this->hasMany(Prescription::class, 'id_diagnoses');
    }

    public function pasien(){
        return $this->belongsTo(Patient::class, 'id_patient');
    }

    public function dokter(){
        return $this->belongsTo(Doctor::class, 'id_doctor');
    }

    public function serviceType(){
        return $this->belongsTo(ServiceType::class, 'id_service_type');
    }
}
