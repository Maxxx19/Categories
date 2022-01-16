<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\People;
use Illuminate\Support\Facades\Redis;

class ProcessStoreData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    protected $url_params = ['people', 'planets', 'films'];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //$data = json_decode($data->get($this->url_params[0]));
        //$redis = Redis::connection();
        $this->data = $data;
        //$val = (array)$val[1];
        //People::create($val);
       // $this->data = $request;
       
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
//dd('here');
       // if(isset($this->data) && !empty($this->data))
       //{
            foreach($this->data as  $val)
            {  
                $val = (array)$val;
                /*People::create([
                    'name' => $val['name'],
                    'height' => $val['height'],
                    'mass' => $val['mass'],
                    'hair_color' => $val['hair_color'],
                    'skin_color' => $val['skin_color'],
                    'eye_color' => $val['eye_color'],
                    'birth_year' => $val['birth_year'],
                    'gender' => $val['gender'],
                    'homeworld' => $val['homeworld'],
                    'url' => $val['url'],
                ]);*/
                People::create($val);
                //dd('ye');
            }
       // }
    }
}
