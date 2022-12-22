<?php

namespace App\Services;

use App\Models\SubscriptionPlan;
use App\Models\User;
use App\Services\Contracts\CreateContact;
use App\Services\Helpers\Contact;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;


class PaymentService
{

    public $baseRazorUrl = "https://api.razorpay.com/v1/";
    public function __construct(public $token, public $secret, public $currecny ,public $account_number){}

    protected function setUp()
    {

    }

    protected function sendPostRequest($endPoint, $data){
        $url = $this->baseRazorUrl . $endPoint;
        return Http::withBasicAuth($this->token, $this->secret)->post($url,$data);
    }

    protected function sendPatchRequest($endPoint, $data){
        $url = $this->baseRazorUrl . $endPoint;
        return Http::withBasicAuth($this->token, $this->secret)->patch($url,$data);
    }

    public function createContact(Contact $contact)
    {
        $endPoint = "contacts";
        $contactData =  $contact->toArray();
        $contactDetails = $this->sendPostRequest($endPoint,$contactData);

        $response = $contactDetails->json();
        if(array_key_exists("error", $response)){
            return response()->json(["type"=>"error","response"=>$response]);
        };
        $contactId = $contactDetails->json()['id'];
        $endPoint .= "/".$contactId;
        $this->sendPatchRequest($endPoint,["active"=>true]);
        return response()->json(["type"=>"success","id"=>$response['id']]);


    }

    public function createFundAccount($data)
    {
        $endPoint = "fund_accounts";
        $fundAccountData =  $data;
        $fundAccountDetails = $this->sendPostRequest($endPoint,$fundAccountData);
        $response = $fundAccountDetails->json();
        if(array_key_exists("error", $response)){
            return response()->json(["type"=>"error","response"=>$response]);
        };

        $fundAccId = $fundAccountDetails->json()['id'];
        $endPoint .= "/".$fundAccId;
        $this->sendPatchRequest($endPoint,["active"=>true]);
        return response()->json(["type"=>"success","id"=>$response['id']]);
    }

    public function makeBankPayment($fundAccountId, $amount, $purpose, $referenceId, $notes)
    {
        $op = Http::withBasicAuth($this->token, $this->secret)->post("https://api.razorpay.com/v1/payouts",[

                "account_number"=> $this->account_number,
                "fund_account_id"=> $fundAccountId,
                "amount"=> $amount,
                "currency"=> $this->currecny,
                "mode"=> "IMPS",
                "purpose"=> Str::limit($purpose,'27', '...'),
                "queue_if_low_balance"=> true,
                "reference_id"=> $referenceId,
                "narration"=> "Acme Corp Fund Transfer",
                "notes"=> $notes
        ]);
        return $op;
    }


    public function createPlan(SubscriptionPlan $plan){
        $endPoint = "plans";

        $days = $plan->days;
        $name = $plan->name;
        $amount = $plan->amount;
        $fundAccountData = array('period' => 'daily', 'interval' => $days, 'item' => array('name' => $name, 'description' => 'Description for the weekly 1 plan', 'amount' => $amount, 'currency' => $this->currecny),'notes'=> array('key1'=> 'value3','key2'=> 'value2'));
        //  dd($fundAccountData);
        $planResponse = $this->sendPostRequest($endPoint,$fundAccountData);
        $response = $planResponse->json();
        return response()->json(["type"=>"success","id"=>$response['id']]);
    }

    public function makePayment()
    {

    }

    public function saveTransaction(){

    }

    public function fetchSubscriptions($planId){
        $op = Http::withBasicAuth($this->token, $this->secret)->get("https://api.razorpay.com/v1/subscriptions",[
            "plan_id"=> $planId
        ]);
        $allSubscriptions = collect(($op->json())['items']);
        //->filter(function($item){ return $item['status']=="active"; });
        return $allSubscriptions;
    }
}
