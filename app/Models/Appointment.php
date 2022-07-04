<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable= [
        'id_doctor',
        'id_patient',
        'id_service_type',
        'status',
        'no_janji',
        'tanggal_periksa',
        'waktu',
        'keluhan',
    ];

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
