<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * It will save the cities data for Indian states only
     *
     * @return void
     */
    public function run()
    {
        $client = new \GuzzleHttp\Client(['headers' => ['X-CSCAPI-KEY' => 'U2dHRzlKeE9Pc0VaZ1F6b3ptN1JlaEM3RGhiRlpFWDNmSzRYeFdnWg==']]);
        $result = $client->request('GET', 'https://api.countrystatecity.in/v1/countries/IN/states/');
        $resultData =  $result->getBody()->getContents();
        $statesArray = json_decode($resultData, true);
        $states = [];
        foreach ($statesArray as $statekey => $state) {
            $client = new \GuzzleHttp\Client(['headers' => ['X-CSCAPI-KEY' => 'U2dHRzlKeE9Pc0VaZ1F6b3ptN1JlaEM3RGhiRlpFWDNmSzRYeFdnWg==']]);
            $result = $client->request('GET', 'https://api.countrystatecity.in/v1/countries/IN/states/'.$state['iso2'].'/cities');
            $resultData =  $result->getBody()->getContents();
            $citiesArray = json_decode($resultData, true);
            $stateid = $statekey+1;
            $cities = [];

            foreach ($citiesArray as $key => $city) {
                $cities[$key]['name'] = $city['name'];
                $cities[$key]['country_id'] = '101';
                $cities[$key]['state_id'] = $stateid;
                $cities[$key]['created_at'] = Carbon::now()->format('Y-m-d H:i:s');
                $cities[$key]['updated_at'] = Carbon::now()->format('Y-m-d H:i:s');
            }
            DB::table('cities')->insert($cities);            
        }
        
    }
}
