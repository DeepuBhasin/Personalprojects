<?php

namespace App\Http\Controllers;

use App\Models\OrderPayment;
use App\Models\RazorpayPost;
use App\Models\UserSubscription;
use App\Models\UserSubscriptionInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RazorpayResponseHandler extends Controller
{
    //
    public function processTransaction(){
        Log::debug('processTransaction Called.');
        $request = file_get_contents('php://input');
        $req_dump = print_r( $request, true );
        $fp = file_put_contents( 'request.log', $req_dump );

        $data = file_get_contents('php://input');
        RazorpayPost::create(['hook_data'=>$data]);
        $json = json_decode($data);
        Log::debug('JSON Decoded.');
        // $json = json_encode($json, true);
        if(isset($json->payload->payout) && isset($json->payload->payout->entity) && isset($json->payload->payout->entity->id)){
            $source = $json->payload->payout->entity;
            OrderPayment::withoutEvents(function() use($source){
                $orderPayment = OrderPayment::where('transaction_id',$source->id)->first();
                $order = $orderPayment->order;
                $message = match($orderPayment->type){
                    2 => config('constants.notificationTypes.payment-to-seller-processed'),
                    3 => config('constants.notificationTypes.margin-to-bidder-processed'),
                };
                if($orderPayment->payment_type === 2){
                    $seller = $order->product->user;
                    $this->sendPushNotification(
                        $seller->device_token,
                        $message,
                        $seller->device_type
                    );
                }
                if($orderPayment->payment_type === 3){
                    $bidder = $order->bid->user;
                    $this->sendPushNotification(
                        $bidder->device_token,
                        $message,
                        $bidder->device_type
                    );
                }
                $orderPayment->update(['payment_status'=>$source->status]);
            });
        }
        Log::debug('Paying INVOICE.');
        if(isset($json->payload->invoice) && isset($json->payload->invoice->entity) && isset($json->payload->invoice->entity->subscription_id)){
            Log::debug('Subscription FOuND.');
            $subscription_id = $json->payload->invoice->entity->subscription_id;
            $invoice_id = $json->payload->invoice->entity->id;
            $invoice_status = $json->payload->invoice->entity->status;
            $billing_start = $json->payload->invoice->entity->billing_start;
            $billing_end = $json->payload->invoice->entity->billing_end;
            //UserSubscriptionInvoice::withoutEvents(function() use($source){
            Log::debug('Updating Subscription.');
            $isExistingInvoie = UserSubscriptionInvoice::where(['invoice_id'=>$invoice_id]);
            if($invoice_status=="paid"){
                UserSubscription::where(['status' => config('constants.user_subscription_status.authenticated'), 'razorpay_subscription_id'=>$subscription_id])->update(['status'=>config('constants.user_subscription_status.active')]);
            }
            if(!$isExistingInvoie->count()){
                UserSubscriptionInvoice::create([
                    'invoice_id'=>$invoice_id,
                    'invoice_status'=>$invoice_status,
                    'razorpay_subscription_id'=>$subscription_id,
                    'billing_start_date'=>$billing_start?date('Y-m-d',$billing_start):null,
                    'billing_end_date'=>$billing_start?date('Y-m-d',$billing_end):null,
                    'razorpay_invoice_data'=>$data,
                ]);
            }

            //});
        }

        return response()->json(['msg'=>'ok'],200);
    }
}
