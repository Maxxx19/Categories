<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Http;

trait SaveRedisData
{
    public function countData($url, $param)
    {
        $url = $url . $param . '1';
        $response = Http::get($url);
        if ($response->getStatusCode() == 200) { // 200 OK
            $count = $response['count'];
        }
        return $count;
    }

    public function saveData($url, $name, $data, $count)
    {
        $redis = Redis::connection();
        $url_main = $url . $name . $data;
        for ($i = 1; $i < $count; $i++) {
            $url = $url_main . $i;
            $response = Http::get($url);
            if ($redis->get($name) != null) {
                $before = json_decode($redis->get($name));
                $redis->set($name, json_encode(array_merge($before, $response['results'])));
            } else {
                $redis->set($name, json_encode($response['results']));
            }
            $after = json_decode($redis->get($name));
            if (count($after) >= $count) {

                break;
            }
        }
        return $after;
    }
}
