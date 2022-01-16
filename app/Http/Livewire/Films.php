<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Film;

class Films extends Component
{
    public $title;
    public $opening_crawl;

    protected $rules = [
        'title' => 'required|max:100',
        'opening_crawl' => 'required|max:100'
    ];

    public $designTemplate = 'tailwind';

    public function render()
    {
        $films = Film::all();
        if (!isset($films[0])) $films = null;

        return view('livewire.films', compact('films'));
    }

    public function show($id)
    {
        $film = Film::findOrFail($id);
       //dd($film->people[3]->starships);

        return view('livewire.people', compact('film'));
           
    }
}
