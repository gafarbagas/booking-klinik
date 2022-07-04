<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralLetter extends Model
{
    use HasFactory;

    protected $fillable= [
        'id_doctor',
        'id_patient',
        'tujuan_dokter',
        'tujuan_lokasi',
        'keluhan',
        'diagnosis_sementara',
        'tindakan',
        'catatan',
    ];

    public function pasien(){
        return $this->belongsTo(Patient::class, 'id_patient');
    }

    public function dokter(){
        return $this->belongsTo(Doctor::class, 'id_doctor');
    }
}
