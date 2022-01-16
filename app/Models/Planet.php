<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'rotation_period',
        'orbital_period',
        'diameter',
        'climate',
        'gravity',
        'terrain',
        'surface_water',
        'population',
        'url',
        'created',
        'edited',
    ];
    public function films()
    {
        return $this->belongsToMany(Film::class);
    }
    public function residents()
    {
        return $this->hasMany(Resident::class);
    }
}
