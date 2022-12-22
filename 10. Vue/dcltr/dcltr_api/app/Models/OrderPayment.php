<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'transaction_id',
        'amount',
        'card_number',
        'payment_method',
        'payment_status',
        'reference_id',
        'payment_by',
        'paid_to',
        'payment_type',
    ];

    //protected $with = ['order'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id','id');
    }
}
