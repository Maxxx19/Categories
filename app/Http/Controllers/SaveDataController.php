<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;
use App\Models\People;
use App\Models\Planet;
use App\Models\Film;
use App\Models\Species;
use App\Models\Vehicle;
use App\Models\Starship;

class SaveDataController extends Controller
{
    protected $url_params = ['people', 'planets', 'films'];

    public function store()
    {
        $redis = Redis::connection();
        $param = $this->url_params;
        for ($i = 0; $i <= 2; $i++) {
            $data = json_decode($redis->get($param[$i]));
            foreach ($data as  $val) {
                $val = (array)$val;
                if ($i == 0) {
                    $people = People::create($val);
                    $this->createIfNeeded($val, 'species', $people->id, $i);
                    $this->createIfNeeded($val, 'vehicles', $people->id, $i);
                    $this->createIfNeeded($val, 'films', $people->id, $i);
                    if (isset($val['homeworld']) != null) {
                        DB::table('people_planet')->insert(
                            ['planet_id' => explode('/', ($val['homeworld']))[5], 'people_id' => $people->id]
                        );
                    }
                    $this->createIfNeeded($val, 'starships', $people->id, $i);
                }
                if ($i == 1) {
                    $planet = Planet::create($val);
                    $this->createIfNeeded($val, 'films', $planet->id, $i);
                }
                if ($i == 2) {
                    $film = Film::create($val);
                    $this->createIfNeeded($val, 'starships', $film->id, $i);
                    $this->createIfNeeded($val, 'vehicles', $film->id, $i);
                    $this->createIfNeeded($val, 'species', $film->id, $i);
                }
            }
        }
        return back();
    }

    public function createIfNeeded($val, $string, $id = 0, $i)
    {
        if (isset($val[$string][0])) {
            foreach ($val[$string] as $string_url) {
                if ($string == 'species') {
                    $species = Species::where('title', $string_url)->get()->first();
                    if ($i == 0) {
                        if (empty($species)) {
                            Species::create([
                                'title' => $string_url,
                                'people_id' => $id,
                            ]);
                        }
                    }
                    if ($i == 2) {
                        if (empty($species)) {
                            $species = Species::create([
                                'title' => $string_url,
                            ]);
                        }
                        DB::table('film_species')->insert(
                            ['species_id' => $species->id, 'film_id' => $id]
                        );
                    }
                }
                if ($string == 'vehicles') {
                    $vehicle = Vehicle::where('title', $string_url)->get()->first();
                    if (empty($vehicle)) {
                        $vehicle = Vehicle::create([
                            'title' => $string_url,
                        ]);
                    }
                    if ($i == 0) {
                        DB::table('people_vehicle')->insert(
                            ['vehicle_id' => $vehicle->id, 'people_id' => $id]
                        );
                    } else {
                        DB::table('film_vehicle')->insert(
                            ['vehicle_id' => $vehicle->id, 'film_id' => $id]
                        );
                    }
                }
                if ($string == 'films') {
                    if ($i == 0) {
                        DB::table('film_people')->insert(
                            ['film_id' => explode('/', $string_url)[5], 'people_id' => $id]
                        );
                    } else {
                        DB::table('film_planet')->insert(
                            ['film_id' => explode('/', ($string_url))[5], 'planet_id' => $id]
                        );
                    }
                }
                if ($string == 'starships') {
                    $starship = Starship::where('title', $string_url)->get()->first();
                    if (empty($starship)) {
                        $starship = Starship::create([
                            'title' => $string_url,
                        ]);
                    }
                    if ($i == 0) {
                        DB::table('people_starship')->insert(
                            ['starship_id' => $starship->id, 'people_id' => $id]
                        );
                    } else {
                        DB::table('film_starship')->insert(
                            ['starship_id' => $starship->id, 'film_id' => $id]
                        );
                    }
                }
            }
        }
    }
}
