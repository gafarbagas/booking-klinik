<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    use HasFactory;
    protected $fillable= [
        'service_type_name'
    ];

    public function dokter()
    {
        return $this->belongsToMany(Doctor::class, Service::class, 'id_doctor','id_service_type');
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class, 'id_service_type');
    }

    public function diagnosis()
    {
        return $this->hasMany(Diagnosis::class, 'id_service_type');
    }
}
