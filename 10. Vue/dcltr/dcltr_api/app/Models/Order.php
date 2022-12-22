<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'address_id',
        'bid_id',
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id')->with(['addresses', 'uploads', 'bids' => function($q) {
            $q->select('id', 'product_id','bid_amount', 'charges', 'total_amount', 'status', 'added_by')
            ->where('added_by', auth()->user()->id);
        }])->select('id', 'title', 'description', 'price', 'address_id', 'sale_option_id');
    }

    public function address(){
        return $this->belongsTo(UserAddress::class, 'address_id', 'id')->with('city', 'state', 'country')
        ->select('id', 'address', 'latitude', 'longitude', 'city_id', 'state_id', 'country_id');
    }

    public function product_details()
    {
        return $this->belongsTo(Product::class,'product_id','id')
        ->select('id', 'title','description','price');

    }

    public function payment_details()
    {
        return $this->belongsTo(OrderPayment::class, 'id','order_id');
    }


    public function shipping_address()
    {
        return $this->belongsTo(UserAddress::class, 'address_id','id')
        ->select('id', 'address');
    }

    public function payments(){
        return $this->hasMany(OrderPayment::class, 'order_id');
    }

    public function uploads()
    {

        return $this->hasMany("App\Models\Upload", 'ref_id', 'product_id')->select(['filename', 'filetype', 'ref_id', 'filepath']);
    }

    public function bid(){
        return $this->belongsTo(ProductBidding::class, 'order_id', 'id');
    }
}
