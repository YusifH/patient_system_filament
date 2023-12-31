<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }
    public function patient(){
        return $this->belongsTo(Patient::class);
    }
    public function diagnosis(){
        return $this->belongsTo(Diagnosis::class);
    }
    public function doctor_advices()
    {
        return $this->belongsToMany(DoctorAdvice::class);
    }
}
