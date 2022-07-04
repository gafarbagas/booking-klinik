<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $table = 'patients';
    protected $fillable = [
        'id_user',
        'nik',
        'no_hp',
        'jenis_kelamin',
        'alamat',
        'tanggal_lahir',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class, 'id_patient');
    }

    public function diagnosis()
    {
        return $this->hasMany(Diagnosis::class, 'id_patient');
    }

    public function surat()
    {
        return $this->hasMany(CertificateRest::class, 'id_patient');
    }

    public function rujukan()
    {
        return $this->hasMany(ReferralLetter::class, 'id_patient');
    }

}
