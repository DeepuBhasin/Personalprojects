<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'description',
        'donation_limit',
        'company_name',
        'company_address',
        'email',
        'image',
        'start_date',
        'end_date',
        'is_active',
        'need_inspection',
        'admin_id',
    ];

    public function cities()
    {
        return $this->hasMany(CampaignCity::class)->with('cityName');
    }
}
