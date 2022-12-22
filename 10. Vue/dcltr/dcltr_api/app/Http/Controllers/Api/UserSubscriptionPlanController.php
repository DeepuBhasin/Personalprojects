<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserSubscription;
use App\Models\SubscriptionPlan;
use App\Http\Resources\SubscriptionResource;
use App\Http\Requests\UserSubscriptionRequest;
use App\Models\ApiRequestData;
use Illuminate\Support\Facades\Auth;

class UserSubscriptionPlanController extends Controller
{
    public function getAllSubscriptions(Request $request)
    {   $user = auth()->user();
        if (!empty($user)) {
            return SubscriptionResource::collection(SubscriptionPlan::all());
        } else {
            return response()->json(['error' => __('apiMessage.unauthorized')], 400);
        }

    }

    public function submitUserSubscription(UserSubscriptionRequest $request)
   {
        $user = auth()->user();
        $data = file_get_contents('php://input');
        //ApiRequestData::create(['request'=>json_encode($data)]);
        if (!empty($user)) {

            $subscription_data = $request->subscription_data ?? '';
            $subscription_data_array = json_decode($subscription_data, true);
            $razorpay_subscription_id  = '';
            if (!empty($subscription_data_array)) {
                    $razorpay_subscription_id = $subscription_data_array['data']['nameValuePairs']['razorpay_subscription_id'];
            }
            $activeSubscriptions = UserSubscription::where(['user_id' => $user->id,'status' => config('constants.user_subscription_status.active'), 'subscription_plan_id'=>$request->subscription_plan_id]);
            if($activeSubscriptions->count()){
                return response()->json(['message' => __('apiMessage.alreadyActiveSubscription')]);
            }
            elseif(UserSubscription::where(['user_id' => $user->id,'status' => config('constants.user_subscription_status.active')])){
                /**
                 * UPGRADE OR DOWNGRADE THE PLANS
                 * Need to cancel the current subscription
                */
                UserSubscription::where(['user_id' => $user->id,'status' => config('constants.user_subscription_status.active')])->update(['status' => config('constants.user_subscription_status.canceled'),]);
                //Now Proceed to create New Plan
            }
            else{

            }
            $result = UserSubscription::create([
                'user_id' => $user->id,
                'subscription_plan_id' => $request->subscription_plan_id,
                'name' => $request->plan_name,
                'amount' => $request->amount,
                'isSuccessfulTransaction' => $request->payment_status,
                'status' => config('constants.user_subscription_status.authenticated'),
                'no_of_leads' => $request->no_of_leads,
                'is_lead_carry_over' => $request->is_lead_carry_over,
                'razorpay_subscription_id' => $razorpay_subscription_id,
                'subscription_response' => $request->subscription_json,
                'current_plan_data'=>SubscriptionPlan::find($request->subscription_plan_id)->toJson()
            ]);

            //$result = UserSubscription::create($request->validated() + ['user_id' => $user->id, ]);

            if ($result) {
                return response()->json([
                    'message' => __('apiMessage.createUserSubscription'),
                    'status' => 'success'
                ]);
            } else {
                return response()->json(['message' => __('apiMessage.errorMsg')]);
            }

        } else {
            return response()->json([
                'message'=>__('apiMessage.unauthorized'),
                'status'=> 'error'
            ]);
        }
    }
}
