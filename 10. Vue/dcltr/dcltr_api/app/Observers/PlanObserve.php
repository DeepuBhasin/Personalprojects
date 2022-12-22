<?php

namespace App\Observers;

use App\Models\SubscriptionPlan;

class PlanObserve
{
    //

    public function created(SubscriptionPlan $plan){

        $paymentObj = resolve('razorpay');
        $response = $paymentObj->createPlan($plan);
        // $plan->razorpay_plan_id = $response->getData()->id;
        // dd($response->getData()->id);
        SubscriptionPlan::withoutEvents(function() use($response, $plan){
            SubscriptionPlan::find($plan->id)->update(['razorpay_plan_id' => $response->getData()->id]);
        });


        // $plan->save();
    }

    public function updated(SubscriptionPlan $plan){

        $paymentObj = resolve('razorpay');
        $response = $paymentObj->createPlan($plan);

        SubscriptionPlan::withoutEvents(function() use($response, $plan){
            SubscriptionPlan::find($plan->id)->update(['razorpay_plan_id' => $response->getData()->id]);
        });

        // $plan->save();
    }


}
