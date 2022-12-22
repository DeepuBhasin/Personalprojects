<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBidding extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'bid_amount',
        'total_amount',
        'charges',
        'status',
        'added_by',
    ];
    protected $appends = ['statusText'];

    protected function getStatusTextAttribute()
    {
        return array_flip(config('constants.bidStatus'))[$this->status];
    }

    public function user(){
        return $this->belongsTo(User::class,"added_by");
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function products(){
        return $this->hasOne(Product::class, 'id', 'product_id')->with(['uploads' => function($q) {
            $q->where('filetype', '=', config('constants.fileTypes.productPhoto'));
        }])
        ->select('id','title','description', 'price', 'sale_option_id', 'status');
    }

    public function order(){
        return $this->hasOne(Order::class, 'bid_id');
    }
}
