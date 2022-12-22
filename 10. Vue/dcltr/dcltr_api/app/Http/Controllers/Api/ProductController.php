<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Admin;
use App\Models\Upload;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductRating;
use App\Models\ProductBidding;
use App\Models\UserAddress;
use App\Models\CategoryFormData;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Traits\PushNotificationTrait;
use App\Http\Resources\ProductResource;
use App\Http\Requests\SaveRatingRequest;
use App\Notifications\UserUploadProduct;
use App\Http\Resources\ProductCollection;
use App\Http\Requests\UploadProductRequest;
use App\Http\Resources\SellOptionsResource;
use App\Http\Resources\AllProductCollection;
use App\Notifications\ProductApproved;
use App\Notifications\ProductRejected;
use App\Traits\CronTrait;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\JsonResponse;
use App\Models\Response;
use App\Models\UserSubscription;
class ProductController extends Controller
{
    use PushNotificationTrait;

    public function getProducts(Request $request)
    {
        $product_name = $request->product_name;
        if (!empty($product_name)) {
            $products = Product::with(['uploads' => function($q) {
                $q->where('filetype', '=', config('constants.fileTypes.productPhoto'));
            }])
            ->where('title', $product_name)->get();

        } else {
            $products = Product::with(['uploads' => function($q) {
                $q->where('filetype', '=', config('constants.fileTypes.productPhoto'));
            }])->get();
        }
        foreach ($products as $datakey => $product) {
            if (!empty($product['uploads'])) {
                foreach ($product['uploads'] as $fileKey => $uploaddata) {
                    $products[$datakey]['uploads'][$fileKey]['filepath'] = 'storage/'.$uploaddata['filepath'];
                    foreach (config('constants.fileTypes') as $filetype => $value) {
                        if ($uploaddata['filetype'] == $value) {
                            $products[$datakey]['uploads'][$fileKey]['filetype'] = $filetype;
                        }

                    }
                }
            }
        }
        return new ProductCollection($products);
    }

    public function getProductOverviews(Request $request)
    {
        $product_id = $request->product_id;
        if (!empty($product_id)) {
            $products = product::where('id', $product_id)
            ->with(['uploads' => function($q) {
                $q->where('filetype', '=', config('constants.fileTypes.productPhoto'));
            }])->get();
            if (!$products->isEmpty()) {
                return new ProductCollection($products);
            }
            else {
                return response()->json([
                    'message'=>__('apiMessage.productNotExist'),
                ]);
            }
        }
        else {
            return response()->json([
               'message'=>__('apiMessage.errorMsg'),
            ]);
        }
    }

    public function getAllProducts(Request $request)
    {
        // $products = Product::with(['uploads' => function($q) {
        //     $q->where('filetype', '=', config('constants.fileTypes.productPhoto'));
        // }])->get();
        // ,'bids'=>function($query){
        //     return $query->where('added_by',auth()->user()->id);
        // }
        $user = auth()->user();
        $userProductTypes = [];
        $city_id = isset($request->city_id) ? $request->city_id : '';
        if (!empty($user)) {
            $userDetail = User::select('id','is_pro')->with('types.role:id,title')
            ->where('id', $user->id)->get()->toArray();
            //print_r($userDetail);die;
            $productTypesRoles =  config('constants.roleSaleMapping');
            $userRoles = $userDetail[0]['types'];
            foreach($userRoles as $userRole) {
                $userroleid = $userRole['role']['id'];
                foreach($productTypesRoles as $role_id => $productType) {
                    if ($role_id == $userroleid) {
                        $userProductTypes[] = $productType;
                    }
                }
            }
            $userSubscription = UserSubscription::where('user_id', $user->id)->get();
            $responses = Response::where([
                ['user_id', '=', $user->id],
                ['type', '=', 'product'],
            ])->get()->toArray();
            $products_ids = array_column($responses, 'request_id');
            
            if ($userDetail[0]['is_pro'] == 1) {
                $userProductTypes[] = config('constants.sellOptions.share');
                $userProductTypes[] = config('constants.sellOptions.sell');
            }
        }
        //print_r($products_ids);die;
        $query = Product::with(['category','subcategory:id,title','user:id,name', 'uploads' => function($q) {
            $q->where('filetype', '=', config('constants.fileTypes.productPhoto'));
        }])->whereIn('sale_option_id', $userProductTypes)
        ->where('status', config('constants.productStatus.Approved'))
        ->whereNotIn('id', ProductBidding::where('added_by', $user->id)->where('status', '!=', config('constants.bidStatus.assign_by_admin'))->pluck('product_id'))
        ->where('user_id', '!=', $user->id);
        if (!empty($city_id)) {
            $query->whereIn('address_id', UserAddress::where('city_id', $city_id)->pluck('id'));
        }
        if (!empty($userSubscription)) {
            $query->orWhere(function ($query) use ($products_ids, $user) {
                $query->where('sale_option_id', '=', config('constants.sellOptions.toss'))
                    ->where('user_id', '!=', $user->id)
                    ->whereIn('id', $products_ids);
            });
        }
        $query->where('visibilty_status', 0);
        $query->orWhere(function ($query) use ($user) {
            $query->where('visibilty_status', 2)
                  ->where('visibilty_status_updated_by', '!=', $user->id);
        });
        $products = $query->latest()->get();       

        if (!empty($request->lat) && !empty($request->long)) {
            foreach ($products as $product) {
                    $distance = DB::table("user_addresses")
                    ->select(DB::raw("6371 * acos(cos(radians(" . $request->lat . "))
                        * cos(radians(user_addresses.latitude))
                        * cos(radians(user_addresses.longitude) - radians(" . $request->long . "))
                        + sin(radians(" .$request->lat. "))
                        * sin(radians(user_addresses.latitude))) AS distance")
                    )->where('id', $product['address_id'])
                    ->first();

                $product['distance'] = (!empty($distance->distance)) ? $distance->distance : null;
            }
            $products = $products->SortBy('-distance');
        }
        return new ProductCollection($products);
    }

    public function getAllSellOptions() {
        $data =  config('constants.sellOptions');
        $sellOptions = [];
        foreach($data as $option => $value) {
            $sellOptions[$value]['id'] = $value;
            $sellOptions[$value]['option'] = ucfirst($option);
        }
        return new SellOptionsResource($sellOptions);
    }

    public function uploadProduct(UploadProductRequest $request ) {
        $user =  auth()->user();
        $id = isset($request->product_id) ? $request->product_id : '';
        $productExist = Product::where('id', $id)->first();
        if (empty($productExist)) {
            $productUploaded = Product::create([
                'title' => $request->product_name,
                'price' => $request->price,
                'description' => $request->description,
                'sale_option_id' => $request->sale_option_id,
                'time_slots' => $request->time_slots,
                'user_id' => $user->id,
                'address_id' => $request->address_id,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
            ]);
            if ($request->hasFile('product_photo')) {
                $product_photos = $request->file('product_photo');
                foreach($product_photos as $product_photo){
                    $uploadFolder = 'productPhotos';
                    $uploadedPath = $product_photo->store($uploadFolder, 'public');
                    $input['path'] = $uploadFolder."/". basename($uploadedPath);
                    $input['filename'] = $product_photo->getClientOriginalName();
                    Upload::create([
                        'filename' => $input['filename'],
                        'filepath' => $input['path'],
                        'filetype'=> config('constants.fileTypes.productPhoto'),
                        'ref_id' => $productUploaded['id'],
                    ]);
                }
            }
            $custom_data = $request->custom_data ?? '';
            $customArray = json_decode($custom_data, true);
            if ($request->hasFile('custom_file')) {
                $custom_files = $request->file('custom_file');
                foreach ($custom_files as $fieldname => $custom_file) {
                    $uploadFolder = 'customFormFiles';
                    $profileUploadedPath = $custom_file->store($uploadFolder, 'public');
                    $input['path'] = "storage/".$uploadFolder."/". basename($profileUploadedPath);
                    $input['filename'] = $custom_file->getClientOriginalName();
                    $input['fieldname'] = $fieldname;
                    foreach ($customArray as $key => $customData) {
                        if ($customData['type'] == 'file' && $customData['isAttachment'] == true) {
                                if ($input['fieldname'] == $customData['name']) {
                                $customArray[$key]['filepath'] = $input['path'];
                            }
                        }
                    }
                }
            }

            if (!empty($customArray)) {
                CategoryFormData::create([
                    'user_id' => $user->id,
                    'category_dynamic_form_id' => $request->category_dynamic_form_id,
                    'data' => json_encode($customArray),
                    'type_id' => $productUploaded['id'],
                    'type' => 'product'
                ]);
            }
           if ($productUploaded) {
                $notificationDetails = [];
                $notificationDetails['product'] = $productUploaded;
                $notificationDetails['uploadedBy'] = User::find($productUploaded['user_id']);

                $adminUsers = Admin::where('role_id', 1)->get();
                Notification::send($adminUsers, new UserUploadProduct($notificationDetails));
                return response()->json([
                    'message' => __('apiMessage.productUploaded'),
                    'status' => 'success'
                ]);
            } else {
                return response()->json(['message' => __('apiMessage.errorMsg')]);
            }
        }
        else {

            if ($request->hasFile('product_photo')) {
                $product_photos = $request->file('product_photo');
                foreach($product_photos as $product_photo){
                    $uploadFolder = 'productPhotos';
                    $uploadedPath = $product_photo->store($uploadFolder, 'public');
                    $input['path'] = $uploadFolder."/". basename($uploadedPath);
                    $input['filename'] = $product_photo->getClientOriginalName();
                    Upload::create([
                        'filename' => $input['filename'],
                        'filepath' => $input['path'],
                        'filetype'=> config('constants.fileTypes.productPhoto'),
                        'ref_id' => $id,
                    ]);
                }
            }
            $dataToBeUpdate = [];
            $product_name = $request->product_name ?? '';
            if (!empty($product_name)) {
            $dataToBeUpdate['title'] = $product_name;
            }
            $description = $request->description ?? '';
            if (!empty($description)) {
            $dataToBeUpdate['description'] = $description;
            }
            $price = $request->price ?? '';
            if (!empty($price)) {
            $dataToBeUpdate['price'] = $price;
            }
            $sale_option_id = $request->sale_option_id ?? '';
            if (!empty($sale_option_id)) {
            $dataToBeUpdate['sale_option_id'] = $sale_option_id;
            }
            $time_slots = $request->time_slots ?? '';
            if (!empty($time_slots)) {
            $dataToBeUpdate['time_slots'] = $time_slots;
            }
            $address_id = $request->address_id ?? '';
            if (!empty($address_id)) {
            $dataToBeUpdate['address_id'] = $address_id;
            }
            $category_id = $request->category_id ?? '';
            if (!empty($category_id)) {
            $dataToBeUpdate['category_id'] = $category_id;
            }
            $subcategory_id = $request->subcategory_id ?? '';
            if (!empty($subcategory_id)) {
            $dataToBeUpdate['subcategory_id'] = $subcategory_id;
            }
            Product::where('id', $id)->update($dataToBeUpdate);

            $custom_data = $request->custom_data ?? '';
            $customArray = json_decode($custom_data, true);
            if ($request->hasFile('custom_file')) {
                $custom_files = $request->file('custom_file');
                foreach ($custom_files as $fieldname => $custom_file) {
                    $uploadFolder = 'customFormFiles';
                    $profileUploadedPath = $custom_file->store($uploadFolder, 'public');
                    $input['path'] = "storage/".$uploadFolder."/". basename($profileUploadedPath);
                    $input['filename'] = $custom_file->getClientOriginalName();
                    $input['fieldname'] = $fieldname;
                    foreach ($customArray as $key => $customData) {
                        if ($customData['type'] == 'file' && $customData['isAttachment'] == true) {
                                if ($input['fieldname'] == $customData['name']) {
                                $customArray[$key]['filepath'] = $input['path'];
                            }
                        }
                    }
                }
            }

            if (!empty($customArray)) {
                CategoryFormData::where('id', $request->category_dynamic_form_id)->update([
                    'user_id' => $user->id,
                    'data' => json_encode($customArray),
                    'type_id' => $id,
                    'type' => 'product'
                ]);
            }
            return response()->json([
                'message'=>__('apiMessage.productUpdated'),
                'status'=> 'success'
            ]);
        }
    }



    public function list(Request $request){
        if($request->has('debug')){return response()->json($request->all());}
        $products = Product::with('bids', 'bids.user');

        $perPage = $request->has('per_page')?$request->get('per_page'):10;

        if($request->has('sort_by')){

            $products = $products->orderBy($request->get('sort_by'),$request->get('sort_direction')==-1?'DESC':'ASC');
        }
        if($request->has('filterKey')){
            foreach ($request->filterKey as $key => $col) {
                # code...

                $val = $request->filterVal[$key];
                if($val != ''){
                    if(strpos($col, '.')){
                        $collArr = explode('.',$col);
                        $products->whereHas($collArr[0], function($q) use($collArr,$val) { $q->where($collArr[1], "LIKE", "%".$val."%"); } );
                    }
                    else{
                        $products = $products->where($col, "LIKE", "%".$val."%");
                    }

                }

            }
        }
        $products = $products->paginate($perPage);
        return new ProductCollection($products);
    }

    public function show(Request $request, $product){

        $productLoaded = Product::with(['category:id,title','subcategory:id,title','addresses','addresses.city', 'addresses.state', 'addresses.country','user','user.bankDetail',  'uploads' => function($q) {
            $q->where('filetype', '=', config('constants.fileTypes.productPhoto'));
        }])->where('id', $product)->first();
        //return response()->json($productLoaded);
        return new ProductResource($productLoaded);
    }

    public function submitProductRating(SaveRatingRequest $request)
    {
        $user =  auth()->user();
        if (!empty($user)) {
            $RatingSubmitted = ProductRating::create($request->validated() + ['user_id' => $user->id]);
            if ($RatingSubmitted) {
                return response()->json([
                    'message' => __('apiMessage.productRatingSubmitted'),
                    'status' => 'success'
                ]);
            } else {
                return response()->json(['message' => __('apiMessage.errorMsg')]);
            }
        } else {
            return response()->json([
                'message' => __('apiMessage.unauthorized'),
                'status' => 'error'
            ]);
        }
    }


    public function updateStatus(Request $request, $id){
        $method = $request->method();
        $product = Product::find($id);
        $idUpdated = match($method){
            'GET'   =>  $product->update(['status'=>config('constants.responseStatus.accepted')]),
            'POST'   =>  $product->update(['status'=>config('constants.responseStatus.rejected'), 'status_reason' => $request->reason])
        };
        if ($idUpdated) {
            $msg = match($method){
                'GET'   =>  __('apiMessage.productApproved'),
                'POST'   =>  __('apiMessage.productRejected')
            };

            $user = User::find($product->user_id);
            $purpose = '';
            if ($product->sale_option_id == config('constants.sellOptions.recycle')) {
                $purpose = 'for recycling';
            }
            $notificationData = [];
            $notificationData['message'] = match($method) {
                'GET'   =>  'Your product' . $product->title . 'has been approved'.$purpose,
                'POST'  =>  'Your product' . $product->title . 'has been rejected'.$purpose
            };

            $notificationData['title'] = match($method) {
                'GET'   =>  'Product Approved',
                'POST'  =>  'Product Rejected'
            };
            $notificationData["type"] = match($method) {
                'GET'   =>  config('constants.notificationTypes.product-approved'),
                'POST'  =>  config('constants.notificationTypes.product-rejected')
            };
            $notificationData["product_id"] = $product->id;
            $this->sendPushNotification(
                $user->device_token,
                $notificationData,
                $user->device_type
            );
            match($method){
                'GET'   =>  Notification::send($user, new ProductApproved($notificationData)),
                'POST'   =>  Notification::send($user, new ProductRejected($notificationData))
            };

            return response()->json(['message' => $msg, 'id'=>$idUpdated, 'status'=>config('constants.responseStatus.accepted') ]);
        } else {
            return response()->json(['message' => __('apiMessage.errorMsg')]);

        }
    }


    public function getRelatedUsers(Request $request, $product){
        // $request->
        $productData = Product::where('id', $product)->first();
        $users = User::whereHas('companies.categories' , function($query) use($productData){
            $query->where('subcategory_id',$productData->subcategory_id);
        })->with(['companies.categories', 'bids'=>function($query) use ($product) {
            $query->where('product_id', $product);
        }])->get();

        return response()->json($users);
    }


    public function saveRelatedUsers(Request $request, Product $product){

        $recyclers = array_unique(is_array($request->selected_users)?$request->selected_users:[$request->selected_users]);


        //$message = $request->message;

        $product_id = $request->pid;
        $charges = $request->amount_to_be_deducted;
        Product::where('id', $product_id)->update(['ia_amount'=>$charges]);
        //ProductBidding::where('product_id',$product_id)->delete();
        $alreadyBidded = ProductBidding::where('product_id',$product_id)->get()->pluck('added_by')->toArray();
        $idsToBeRemoved = array_diff($alreadyBidded,$recyclers );
        ProductBidding::where(['product_id'=>$product_id, 'status'=> config('constants.bidStatus.assign_by_admin')])->delete();
        if(count($idsToBeRemoved)){
            ProductBidding::where('product_id',$product_id)->whereIn('added_by',$idsToBeRemoved)->delete();
        }
        if(count($recyclers)){
            foreach($recyclers as $recycler){
                if(!ProductBidding::where(['product_id'=>$product_id,'added_by'=>$recycler])->count()){
                    ProductBidding::create(['charges'=>$charges, 'bid_amount'=>0, 'total_amount'=> 0, 'product_id'=>$product_id, 'added_by'=>$recycler, 'status'=>config('constants.bidStatus.assign_by_admin')]);
                }
            }
        }
        return response()->json([
            'message' => __('apiMessage.productBiddingRequested'),
            'status' => 'success'
        ]);
        /**
        * Hook Notification Here
        */

        //ProductBidding::create();


    }

    public function acceptBidding(){

    }

    public function refundBiddingAmount(){

    }

    public function assignProductToCharitableOrganization(){

    }


    public function assignPartner(Request $request, $product_id, $admin_id){
        Product::where('id',$product_id)->update(['inspection_agent'=>$admin_id, 'ia_status'=>config('constants.iaStatus.assigned')]);
        return response()->json([
            'message'=>__('apiMessage.ia_assigned'),
        ]);
    }

    public function assignDeliveryPartner(Request $request, $product_id, $admin_id){
        Product::where('id',$product_id)->update(['delivery_boy'=>$admin_id, 'da_status'=>config('constants.iaStatus.assigned')]);
        return response()->json([
            'message'=>__('apiMessage.da_assigned'),
        ]);
    }
    public function assignSelectedBidder(Request $request, $product_id, $userid){
        ProductBidding::where(['product_id'=>$product_id, 'status'=>config('constants.bidStatus.assign_by_admin')])->delete();
        $bidded = ProductBidding::create(['charges'=>0, 'bid_amount'=>0, 'total_amount'=> 0, 'product_id'=>$product_id, 'added_by'=>$userid, 'status'=>config('constants.bidStatus.assign_by_admin')]);
        //$bidded->update(['status'=>config('constants.bidStatus.accepted')]);
        return response()->json([
            'message'=>__('apiMessage.charity_assigned'),
            'data'=>$bidded
        ]);
    }

    public function assignProductTo(Request $request, $bidId){
        $bidded = ProductBidding::where('id',$bidId);

        $bidded->update(['status'=>config('constants.bidStatus.paid_plus_assigned')]);
        $remainingProducts = ProductBidding::where(['product_id'=>$bidded->first()->product_id, 'status'=>2]);
        $remainingProducts->update(['status'=>config('constants.bidStatus.refundable')]);
        return response()->json([
            'message'=>__('apiMessage.product_assigned'),
        ]);
    }

    public function acceptBid(Request $request, $bidId){
        $bidded = ProductBidding::where('id',$bidId)->first();

        //$bidded->update(['status'=>config('constants.bidStatus.accepted')]);
        $bidded->status = config('constants.bidStatus.accepted');
        $bidded->save();
        Product::where('id', $bidded->product_id)
            ->update([
                'is_bid_accepted' => true
            ]);
        return response()->json([
            'message'=>__('apiMessage.bid_accepted'),
        ]);
    }
    public function markPaid(Request $request, $bidId){
        $bidded = ProductBidding::where('id',$bidId);

        $bidded->update(['status'=>config('constants.bidStatus.paid_plus_assigned')]);

        /**
         * Make Product Order Entry (If not)
         * Make Order Payment Entry
         */

        $remainingProducts = ProductBidding::where(['product_id'=>$bidded->first()->product_id, 'status'=>2]);
        $remainingProducts->update(['status'=>config('constants.bidStatus.refundable')]);
        return response()->json([
            'message'=>__('apiMessage.ia_assigned'),
        ]);
    }

    public function payDeliveryPartner(Request $request, $product_id, $admin_id){
        Product::where('id',$product_id)->update(['inspection_agent'=>$admin_id, 'ia_status'=>config('constants.iaStatus.assigned')]);
        return response()->json([
            'message'=>__('apiMessage.ia_assigned'),
        ]);
    }



    public function getNearestCharitables(Request $request, $product){
        $productData = Product::where('id', $product)->first();
        $lat = $productData->addresses->latitude;
        $lon = $productData->addresses->longitude;

        DB::table("user_companies")
            ->select("posts.id"
                ,DB::raw("6371 * acos(cos(radians(" . $lat . "))
                * cos(radians(posts.lat))
                * cos(radians(posts.lon) - radians(" . $lon . "))
                + sin(radians(" .$lat. "))
                * sin(radians(posts.lat))) AS distance"))
                ->groupBy("posts.id")
                ->get();
    }

    public function deleteProduct(Product $product): JsonResponse
    {
        $product->delete();
        return response()->json([
            'message'=>__('apiMessage.productDeleted'),
            'status'=> 'success'
        ]);
    }

    public function updateSharedProductStatus(Request $request)
    {
        $product_id = $request->product_id;
        $status = $request->status;
        $user = auth()->user();
        $productExist = Product::where('id', $product_id)->first();
        if (empty($productExist)) {
            return response()->json([
                'message' => __('apiMessage.productNotExist'),
                'status'=> 'success'
            ]);
        } else {
            $product = Product::where('id', $product_id)->first();
            $product->visibilty_status = $status;
            $product->visibilty_status_updated_by = $user->id;
            $product->save();
            //if share product status  1 means 'accepted', then it will shown in my responses by adding in product biding table
            if ($status == 1) {
                ProductBidding::create([
                    'product_id' => $product_id,
                    'bid_amount' => 0,
                    'total_amount' => 0,
                    'added_by' => $user->id,
                    'status' => config('constants.bidStatus.accepted')
                ]);
                $product->is_bid_accepted = true;
                $product->save();
            }
            return response()->json([
                'message' => __('apiMessage.visibiltyStatusUpdated'),
                'status'=> 'success'
            ]);
        }
    }

    public function deleteProductPhotos(Request $request)
    {
        $user =  auth()->user();
        $uploadedPhotoId = isset($request->photoId) ? $request->photoId : '';
        $product_id = isset($request->product_id) ? $request->product_id : '';
        $productExist = Product::where('id', $product_id)->first();
        if (empty($productExist)) {
            return response()->json([
                'message' => __('apiMessage.productNotExist'),
                'status'=> 'success'
            ]);
        } else {
            Upload::where([
                ['id', '=', $uploadedPhotoId],
                ['ref_id', '=', $product_id],
                ['filetype', '=', config('constants.fileTypes.productPhoto')],
            ])->delete();//deleting product uploads
            return response()->json([
                'message' => __('apiMessage.productPhotoDeleted'),
                'status'=> 'success'
            ]);
        }
    }
}
