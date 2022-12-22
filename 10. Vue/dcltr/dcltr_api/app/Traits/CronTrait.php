<?php

namespace App\Traits;

use App\Models\LeadsHistory;
use App\Models\Product;
use App\Models\Response;
use App\Models\UserRole;
use App\Models\UserType;
use App\Models\UserAddress;
use Illuminate\Support\Carbon;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\DB;

trait CronTrait
{

    public function autoAssignScrapDealerToProduct()
    {
        $allTossProducts = Product::where('status', config('constants.productStatus.Approved'))
            ->where('sale_option_id', config('constants.sellOptions.toss'))->get();
        foreach ($allTossProducts as $product) {
            if (empty($product['address_id'])) {
                continue;
            }

            $productLocation = UserAddress::where('id', $product['address_id'])
                ->select('latitude', 'longitude', 'city_id')->first();

            $response = Response::where('request_id', $product['id'])
                ->where('type', 'product')
                ->orderBy('created_at', 'desc')->first();

            if (empty($response) || $response->created_at < Carbon::now()->subHour(1)) {
                $assignedUsers = Response::where('request_id', $product['id'])->where('type', 'product')->pluck('user_id');
                $scrapDealers = DB::table('user_companies')
                    ->join('user_categories', 'user_categories.user_company_id', '=', 'user_companies.id')
                    ->join('user_subscriptions', 'user_subscriptions.user_id', '=', 'user_companies.user_id')
                    ->join('operational_areas', 'operational_areas.user_company_id', '=', 'user_companies.id')
                    ->where('user_categories.category_id',  $product['category_id'])
                    ->where('user_categories.subcategory_id', $product['subcategory_id'])
                    ->where('operational_areas.city_id', $productLocation->city_id)
                    ->where('user_subscriptions.no_of_leads', '>=', 1)
                    ->where('user_subscriptions.status', 2)
                    ->whereNotIn('user_companies.user_id', $assignedUsers)
                    ->where('user_companies.user_type_id', config('constants.userRoles.Scrap Dealer'))
                    ->select('user_companies.id', 'user_subscriptions.no_of_leads')
                    ->get()->toArray();


                if (empty($scrapDealers)) {
                    continue;
                }

                $availableScrapDealers = DB::table("user_companies")
                    ->select("user_companies.user_id"
                        ,DB::raw("6371 * acos(cos(radians(" . $productLocation->latitude . "))
                        * cos(radians(user_companies.latitude))
                        * cos(radians(user_companies.longitude) - radians(" . $productLocation->longitude . "))
                        + sin(radians(" .$productLocation->latitude. "))
                        * sin(radians(user_companies.latitude))) AS distance")
                    )->whereIn('id', array_column($scrapDealers, 'id'))
                    // ->where('city_id', $productLocation->city_id)
                    ->groupBy("user_companies.id")
                    ->orderBy('distance')
                    ->take(2)
                    ->get();

                $allScrapDealers = [];
                foreach ($availableScrapDealers as $scrapDealer) {
                    array_push($allScrapDealers, $scrapDealer->user_id);
                }

                if (empty($allScrapDealers)) {
                    continue;
                }

                foreach ($allScrapDealers as $userId) {
                    $currentPlan = UserSubscription::where('user_id', $userId)
                        ->where('status', 2)->first();
                    $currentPlan->update([
                        'no_of_leads' => $currentPlan['no_of_leads'] - 1
                    ]);
                    LeadsHistory::create([
                        'user_id' => $userId,
                        'product_id' => $product['id'],
                        'subscription_id' => $currentPlan['subscription_plan_id'],
                    ]);
                    Response::create([
                        'request_id' => $product['id'],
                        'user_id' => $userId,
                        'status' => config('constants.responseStatus.pending'),
                        'type' => 'product',
                    ]);
                }
            }
        }

    }
}
