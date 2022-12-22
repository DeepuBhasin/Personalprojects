<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use HasFactory;
    protected $fillable = [
        'plan_id',
        'name',
        'days',
        'levels',
        'transaction_id',
        'amount',
        'no_of_leads',
        'is_lead_carry_over',
        'added_by',
        'isSuccessfulTransaction',
        'razorpay_plan_id',
        'status'
    ];

    public function userPlans(){
        return $this->hasMany(UserSubscription::class, "subscription_plan_id");
    }
}
