<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateRest extends Model
{
    use HasFactory;

    protected $fillable= [
        'id_doctor',
        'id_patient',
        'no_surat',
        'keterangan',
        'alasan',
        'tanggal_mulai_izin',
        'tanggal_selesai_izin',
        'tanggal_surat',
    ];

    public function pasien(){
        return $this->belongsTo(Patient::class, 'id_patient');
    }

    public function dokter(){
        return $this->belongsTo(Doctor::class, 'id_doctor');
    }
}
