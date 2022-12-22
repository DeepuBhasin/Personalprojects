<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
    ];

    public function product()
    {
        return $this->hasMany(Product::class, 'id','product_id')->with(['uploads' => function($q) {
            $q->where('filetype', '=', config('constants.fileTypes.productPhoto'));
        }]);
        
    }

}