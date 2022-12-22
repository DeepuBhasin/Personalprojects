<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompaignData extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'compaign_id',
        'address_id',
        'quantity',
        'description'
    ];
}
