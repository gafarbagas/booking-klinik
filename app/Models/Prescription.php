<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = ['id_diagnoses','nama_obat','dosis'];

    public function diagnosis()
    {
        return $this->belongsTo(Diagnosis::class, 'id_diagnoses');
    }
}
