<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadsHistory extends Model
{
    use HasFactory;

    protected $table = 'leads_history';

    protected $fillable = [
        'user_id',
        'product_id',
        'subscription_id',
    ];
}
