<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\SaveRedisData;
use Illuminate\Support\Facades\Redis;

class DownloadDataController extends Controller
{
    use SaveRedisData;

    protected $url_params = ['people', 'planets', 'films', '/?page='];
    protected $people = [];
    protected $planets = [];
    protected $films = [];

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $redis = Redis::connection();
        $redis->flushDB();
        $url = "https://swapi.dev/api/";
        for ($i = 0; $i <= 2; $i++) {
            $url_params = $this->url_params[$i] . $this->url_params[3];
           
            $count = $this->countData($url, $url_params);
             
            $data = $this->saveData($url, $this->url_params[$i],$this->url_params[3], $count);
        }

        return back();
    }
}
