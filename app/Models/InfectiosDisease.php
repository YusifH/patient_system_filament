<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfectiosDisease extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function patients()
    {
        return $this->belongsToMany(Patient::class);
    }
}
