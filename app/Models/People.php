<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'height',
        'mass',
        'hair_color',
        'skin_color',
        'eye_color',
        'birth_year',
        'gender',
        'homeworld',
        'created',
        'edited',
        'url',

    ];
    public function films()
    {
        return $this->belongsToMany(Film::class, 'film_people');
    }
    public function species()
    {
        return $this->hasMany(Species::class);
    }
    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class)
            ->withPivot('vehicle_id')
            ->orderBy('title', 'asc');;
    }
    public function starships()
    {
        return $this->belongsToMany(Starship::class)
            ->withPivot('starship_id')
            ->orderBy('title', 'asc');;
    }
}
