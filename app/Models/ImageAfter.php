<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageAfter extends Model
{
    use HasFactory;
    
    protected $fillable = ['id_diagnoses','path','keterangan'];

    public function diagnosis()
    {
        return $this->belongsTo(Diagnosis::class);
    }
}
