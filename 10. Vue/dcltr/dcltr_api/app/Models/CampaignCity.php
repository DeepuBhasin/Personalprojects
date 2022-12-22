<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignCity extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_id',
        'campaign_id'
    ];

    public function compaigns()
    {
        return $this->hasMany(Campaign::class, 'id', 'city_id');
    }

    public function cityName()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }
}
