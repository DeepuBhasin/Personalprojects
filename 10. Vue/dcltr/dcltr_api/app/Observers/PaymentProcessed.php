<?php

namespace App\Observers;

use App\Models\OrderPayment;
use App\Models\Product;
use App\Models\ProductBidding;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PaymentProcessed
{
    //
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function creatings(OrderPayment $op){

        if($op->payment_type == config('constants.payment.PAY-BID-AMOUNT')){
            /**
             * Notify Admin
             */
            // dump($op->order);
            // dump($this->request->all());
            // dd($op);
            $bidId = $op->order->bid_id;
            $productBidded = ProductBidding::where('id', $bidId)->first();
            $productBidded->status = config('constants.bidStatus.paid');
            $productBidded->charges = $this->request->delivery_charges;
            $productBidded->save();
            $productToBeUpdated = Product::where('id',$op->order->product_id)->first();
            $productToBeUpdated->margin = $this->request->margin;
            $productToBeUpdated->da_amount = $this->request->delivery_charges;
            $productToBeUpdated->save();
            //$productToBeUpdated->assigned_bid = $this->request->delivery_charges

            /**
            * Make Payment To Seller
            */
        }
    }

    public function created(OrderPayment $op){
        // dump("creating...");
        // dd($op);
        /**
         * Payment Made By User
         */
        if($op->payment_type == config('constants.payment.PAY-BID-AMOUNT') && Str::lower($op->payment_status)=='success'){
            /**
            * Notify Admin
            */
            $productToBeUpdated = Product::where('id',$op->order->product_id)->first();
            $bidId = $op->order->bid_id;
            $productBidded = ProductBidding::where('id', $bidId)->first();
            if($productToBeUpdated->sale_option_id==6 || $productToBeUpdated->sale_option_id==5 || $productToBeUpdated->sale_option_id==6){
                $productBidded->status = config('constants.bidStatus.paid_plus_assigned');
            }
            else{
                $productBidded->status = config('constants.bidStatus.paid');
            }

            $productBidded->charges = $this->request->delivery_charges;
            $productBidded->save();

            $productToBeUpdated->margin = $this->request->margin;
            $productToBeUpdated->da_amount = $this->request->delivery_charges;
            $productToBeUpdated->save();
            // dd($op);
            /**
             * Make Payment To Seller
             */
        }
    }
}
