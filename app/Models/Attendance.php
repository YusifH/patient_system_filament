<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['patient_id', 'doctor_advice_id', 'count', 'first_date', 'end_date'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctorAdvice()
    {
        return $this->belongsTo(DoctorAdvice::class);
    }
}
