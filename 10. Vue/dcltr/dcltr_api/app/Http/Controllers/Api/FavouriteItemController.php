<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FavouriteItemRequest;
use App\Http\Resources\WishlistResource;
use App\Models\Service;
use App\Models\Product;
use App\Models\Favourite;
use App\Models\ProductBidding;
use DB;

class FavouriteItemController extends Controller
{
    public function saveFavouriteItem(FavouriteItemRequest $request)
    {
        $user =  auth()->user();
        $favItem = Favourite::create([
            'product_id' => $request->product_id,
            'user_id' => $user->id
        ]);
        if($favItem) {
            return response()->json([
                'message' => __('apiMessage.favouriteItemSubmitted'),
                'status' => 'success'
            ]);
        } else {
            return response()->json(['message' => __('apiMessage.errorMsg')]);
        }            
    }

    public function deleteFavouriteItem(Request $request){
        $item_id = $request->item_id;
        if (!empty($item_id)) {
            $favItem = Favourite::where('id', $item_id)->delete();
            if (!empty($favItem)) {
                return response()->json(['message' => __('apiMessage.favouriteItemDeleted')]);
            }
            else {
                return response()->json([
                    'message'=>__('apiMessage.favouriteItemNotExist'),
                ]);
            }
        }
        else {
            return response()->json([
               'message'=>__('apiMessage.errorMsg'),
            ]);
        }
    }

    public function getMyWishlist(Request $request)
    {   
        $user =  auth()->user();
        $user_id = $user -> id;
        $wishlist = Favourite::with('product:id,title,price,description,category_id,subcategory_id')
        ->where([
            ['user_id', '=', $user_id], 
        ])
        ->whereNotIn('product_id', ProductBidding::where('added_by', auth()->user()->id)->where('status', '!=', config('constants.bidStatus.assign_by_admin'))->pluck('product_id'))
        ->get();
        return WishlistResource::collection($wishlist);
    }
}