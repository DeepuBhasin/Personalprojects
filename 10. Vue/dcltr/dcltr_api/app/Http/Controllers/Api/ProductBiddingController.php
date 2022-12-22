<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductBidding;
use App\Http\Requests\SaveProductBidRequest;
use App\Http\Requests\UpdateBidStatusRequest;
use App\Http\Resources\ProductBiddingCollection;
use App\Models\Product;

class ProductBiddingController extends Controller
{
    public function addBidOnProduct(SaveProductBidRequest $request)
    {
        $user = auth()->user();
        $bidExistForProduct = ProductBidding::where('product_id', $request->product_id)
            ->where('added_by', $user->id)->first();
        if (!empty($user)) {
            if (empty($bidExistForProduct)) {
                $result = ProductBidding::create([
                    'product_id' => $request->product_id,
                    'bid_amount' => $request->bid_amount,
                    'charges' => $request->charges,
                    'total_amount' => $request->total_amount,
                    'added_by' => $user->id,
                    'status' => $request->status
                ]);
                if ($result) {
                    return response()->json([
                        'message' => __('apiMessage.bidSubmitted'),
                        'status' => 'success'
                    ]);
                } else {
                    return response()->json(['message' => __('apiMessage.errorMsg')]);
                }
            } else {
                ProductBidding::where('product_id', $request->product_id)
                    ->where('added_by', $user->id)
                    ->update([
                    'bid_amount' => $request->bid_amount,
                    'charges' => $request->charges,
                    'total_amount' => $request->total_amount,
                    'status' => $request->status
                ]);
                return response()->json([
                    'message' => __('apiMessage.bidUpdated'),
                    'status' => 'success'
                ]);
            }
        } else {
            return response()->json([
                'message'=>__('apiMessage.unauthorized'),
                'status'=> 'error'
            ]);
        }
    }

    public function updateBidStatus(updateBidStatusRequest $request)
    {
        $bid_id = $request->bid_id;
        $status = $request->status;
        $status_reason = $request->status_reason;
        $bidExist = ProductBidding::where('id', $bid_id)->first();
        if (empty($bidExist)) {
            return response()->json(['message' => __('apiMessage.bidNotExist')]);
        } else {
            $productBid = ProductBidding::where('id', $bid_id)->first();
            $productBid->status = $status;
            $productBid->status_reason = $status_reason;
            $productBid->save();
            $bidsIds = ProductBidding::where('product_id', $productBid->product_id)
                ->where('id', '!=', $productBid->id)->pluck('id');

            if ($request->status ==  config('constants.bidStatus.accepted')) {
                ProductBidding::whereIn('id', $bidsIds)
                    ->where('status', config('constants.bidStatus.pending'))
                    ->update([
                        'status' => config('constants.bidStatus.on_hold')
                    ]);
                Product::where('id', $productBid->product_id)
                    ->update([
                        'is_bid_accepted' => true
                    ]);

            } elseif ($request->status == config('constants.bidStatus.rejected')) {
                ProductBidding::whereIn('id', $bidsIds)
                    ->where('status', config('constants.bidStatus.on_hold'))
                    ->update([
                        'status' => config('constants.bidStatus.pending')
                    ]);
                Product::where('id', $productBid->product_id)
                    ->update([
                        'is_bid_accepted' => false
                    ]);
            }
            return response()->json(['message' => __('apiMessage.bidStatusUpdated')]);
        }
    }

    public function getAllBids(Request $request)
    {
        $product_id = $request->product_id;
        $productBids = ProductBidding::with(['product:id,title','user:id,name'])
        ->where('product_id', $product_id)->get();
        return $productBids;
        return new ProductBiddingCollection($productBids);
    }
}
