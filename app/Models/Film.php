<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'episode_id',
        'opening_crawl',
        'director',
        'producer',
        'release_date',
        'url',
        'created',
        'edited',
    ];
    public function planets()
    {
        return $this->belongsToMany(Planet::class);
    }
    public function starships()
    {
        return $this->belongsToMany(Starship::class)
            ->withPivot('starship_id')
            ->orderBy('title', 'asc');;
    }
    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class)
            ->withPivot('vehicle_id')
            ->orderBy('title', 'asc');;
    }
    public function species()
    {
        return $this->belongsToMany(Species::class)
            ->withPivot('species_id')
            ->orderBy('title', 'asc');
    }
    public function people()
    {
        return $this->belongsToMany(People::class, 'film_people');
    }
}
