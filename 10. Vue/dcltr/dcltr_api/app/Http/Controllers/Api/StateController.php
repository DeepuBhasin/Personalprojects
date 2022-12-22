<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GetStateCityCountryIdByNameRequest;
use App\Models\State;
use App\Http\Resources\StateCollection;
use App\Http\Requests\StateRequest;
use App\Http\Resources\GetStateCityCountryIdByNameResource;
use App\Models\City;
use App\Models\Country;

class StateController extends Controller
{
    public function getStates(StateRequest $request)
    {
        $country_id = $request->country_id;
        $states = State::where('country_id', $country_id)->orderBy('name')->get();
        return new StateCollection($states);
    }

    public function getCountryCityStateIdByname(GetStateCityCountryIdByNameRequest $request)
    {
        $data = [];
        $data['state_id'] = State::where('name', $request->state)->value('id');
        $data['city_id'] = City::where('name', $request->city)->value('id');
        $data['country_id'] = Country::where('name', $request->country)->value('id');
        return new GetStateCityCountryIdByNameResource($data);
    }
}
