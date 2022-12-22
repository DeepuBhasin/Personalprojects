<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\ProductBidding;
use App\Notifications\SubmitBid;
use App\Traits\PushNotificationTrait;
use Illuminate\Support\Facades\Notification;

class BiddingObserver
{
    use PushNotificationTrait;
    /**
     * Handle the ProductBidding "created" event.
     *
     * @param  \App\Models\ProductBidding  $productBidding
     * @return void
     */
    public function created(ProductBidding $productBidding)
    {
        // send notification
        $notificationData = [];
        $product = Product::with('user')->findOrFail($productBidding->product_id);
        $notificationData["message"] = auth()->user()->name." added a bid on your product ".$product->title;
        $notificationData["title"] = "New bid added";
        $notificationData["type"] = 1;
        $notificationData["product_id"] = $product->id;
        $this->sendPushNotification(
            $product->user->device_token,
            $notificationData,
            $product->user->device_type
        );

        Notification::send($product->user, new SubmitBid($notificationData));

    }

    /**
     * Handle the ProductBidding "updated" event.
     *
     * @param  \App\Models\ProductBidding  $productBidding
     * @return void
     */
    public function updated(ProductBidding $productBidding)
    {
        //
    }

    /**
     * Handle the ProductBidding "deleted" event.
     *
     * @param  \App\Models\ProductBidding  $productBidding
     * @return void
     */
    public function deleted(ProductBidding $productBidding)
    {
        //
    }

    /**
     * Handle the ProductBidding "restored" event.
     *
     * @param  \App\Models\ProductBidding  $productBidding
     * @return void
     */
    public function restored(ProductBidding $productBidding)
    {
        //
    }

    /**
     * Handle the ProductBidding "force deleted" event.
     *
     * @param  \App\Models\ProductBidding  $productBidding
     * @return void
     */
    public function forceDeleted(ProductBidding $productBidding)
    {
        //
    }
}
