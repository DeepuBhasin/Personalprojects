<?php

namespace App\Providers;

use App\Models\BankDetail;
use App\Models\GeneralSetting;
use App\Models\OrderPayment;
use App\Models\ProductBidding;
use App\Models\SubscriptionPlan;
use App\Observers\BankDetailObserver;
use App\Observers\BidAcceptedObserver;
use App\Observers\PaymentProcessed;
use App\Observers\PlanObserve;
use App\Services\Helpers\Contact;
use App\Services\PaymentService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        BankDetail::observe(BankDetailObserver::class);
        ProductBidding::observe(BidAcceptedObserver::class);
        OrderPayment::observe(PaymentProcessed::class);
        SubscriptionPlan::observe(PlanObserve::class);
        $this->app->bind('razorpay', function($app){
            $settings = GeneralSetting::all();
            $currency = $settings->filter(function($item){ return $item->title == 'razor_pay_currency'; })->first()->value;
            $account_number = $settings->filter(function($item){ return $item->title == 'razor_pay_account_number'; })->first()->value;
            $api_key = $settings->filter(function($item){ return $item->title == 'razor_pay_auth_token'; })->first()->value;
            $api_secret = $settings->filter(function($item){ return $item->title == 'razor_pay_secret_key'; })->first()->value;
            // dd($settings);
            return new PaymentService($api_key, $api_secret, $currency, $account_number);
        });
        $this->app->bind('razorpay_contact', function($app){

            return new Contact();
        });
    }
}
