<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'city_id',
        'state_id',
        'country_id',
        'pin',
        'user_id',
        'latitude',
        'longitude',
    ];

    public function city(){
        return $this->belongsTo(City::class, "city_id");
    }


    public function state(){
        return $this->belongsTo(State::class, "state_id");
    }


    public function country(){
        return $this->belongsTo(Country::class, "country_id");
    }

    public function user_company(){
        return $this->hasOne(UserCompany::class,'user_id');
    }
}
