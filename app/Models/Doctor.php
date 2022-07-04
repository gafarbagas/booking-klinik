<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $table = "doctors";
    protected $primary = "id";
    protected $fillable= [
        'id_user',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function serviceType()
    {
        return $this->belongsToMany(ServiceType::class, 'services','id_doctor', 'id_service_type');
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class, 'id_doctor');
    }

    public function diagnosis()
    {
        return $this->hasMany(Diagnosis::class, 'id_doctor');
    }

    public function surat()
    {
        return $this->hasMany(CertificateRest::class, 'id_doctor');
    }

    public function rujukan()
    {
        return $this->hasMany(ReferralLetter::class, 'id_doctor');
    }
}
