<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'film_id',
        'people_id'
    ];

    public function films()
    {
        return $this->belongsToMany(Film::class);
    }
    public function people()
    {
        return $this->belongsToMany(People::class);
    }
}
