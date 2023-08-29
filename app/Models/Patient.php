<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $guarded = [];



    public function city(){
        return $this->belongsTo(City::class);
    }

    public function diagnosis(){
        return $this->hasMany(Diagnosis::class);
    }

    public function infectios_diseases()
    {
        return $this->belongsToMany(InfectiosDisease::class);
    }
}
