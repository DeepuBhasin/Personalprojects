<?php

namespace App\Models;

use App\Models\Scopes\RecyclerScope;
use App\Models\Scopes\CharitableScope;
use App\Models\Scopes\ScrapDealerScope;
use App\Models\Scopes\ServiceProviderScope;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\UserType;
use App\Models\UserCompany;
use App\Models\UserSubscription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $perPage = 5;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'verification_code',
        'image',
        'device_token',
        'device_type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    /*
     * The roles that belong to this user
    */
    public function roles()
    {
        return $this->belongsToMany(UserType::class);
    }

    public function types()
    {
        /*
        * Ideally it should be the Types
        */
        return $this->hasMany(UserRole::class)->with('role:id,title')->select(['user_type_id', 'user_id', 'id']);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new RecyclerScope);
        static::addGlobalScope(new CharitableScope);
        static::addGlobalScope(new ScrapDealerScope);
        static::addGlobalScope(new ServiceProviderScope);
    }

    public function addresses()
    {
        return $this->hasMany(UserAddress::class, 'user_id');
    }

    public function companies()
    {
        return $this->hasMany(UserCompany::class, 'user_id');
    }


    public function scopeRecycler($query){
        return $query->with('types')->whereHas('types', function($q){
            $q->where("user_type_id", config('constants.userRoles.Recycler'));
        });
    }

    public function scopeCharitable($query){
        return $query->with('types')->whereHas('types', function($q){
            $q->where("user_type_id", config('constants.userRoles.Charitable Organization'));
        });
    }

    public function scopeScrapDealer($query){
        return $query->with('types')->whereHas('types', function($q){
            $q->where("user_type_id", config('constants.userRoles.Scrap Dealer'));
        });
    }

    public function scopeServiceProvider($query){
        return $query->with('types')->whereHas('types', function($q){
            $q->where("user_type_id", config('constants.userRoles.Service Provider'));
        });
    }

    public function scopeRegular($query){
        return $query->with('types')->whereHas('types', function($q){
            $q->where("user_type_id", config('constants.userRoles.Customer'));
        });
    }

    public function scopeAll($query){
        return $query->with('types');
    }

    public function usersubscription(){
        return $this->hasMany(UserSubscription::class)->select(['id','user_id','subscription_plan_id','razorpay_subscription_id']);
    }

    public function bids(){
        return $this->hasMany(ProductBidding::class,'added_by','id');
    }

    public function bankDetail(){
        return $this->morphOne(BankDetail::class, 'ownerable');
    }
}
