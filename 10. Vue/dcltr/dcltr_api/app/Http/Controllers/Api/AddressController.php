<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserAddressRequest;
use App\Http\Resources\UserAddressCollection;
use App\Models\UserCompany;
use Illuminate\Http\JsonResponse;

class AddressController extends Controller
{
    public function addUpdateAddress(UserAddressRequest $request)
    {
        $user = auth()->user();
        $id = isset($request->id) ? $request->id : '';
        $addressExist = UserAddress::where('id', $id)->first();
        if (empty($addressExist)) {
            $result = UserAddress::create($request->validated() + ['user_id' => $user->id]);
            if ($result) {
                return response()->json([
                    'message' => __('apiMessage.addressSubmitted'),
                    'addressId' => $result->id,
                    'status' => 'success'
                ]);
            } else {
                return response()->json([
                    'message' => __('apiMessage.unauthorized'),
                    'status' => 'error'
                ]);
            }
        } else {
            UserAddress::where('id', $id)->update($request->validated());
            return response()->json(['message' => __('apiMessage.addressUpdated')]);
        }
    }

    public function getSavedAddresses()
    {
        $user = auth()->user();
        //echo $user;
        if (!empty($user)) {

         $userAddresses = [];
            $userAddresses['userAddress'] = UserAddress::with('city:id,name', 'state:id,name', 'country:id,name')->where('user_id', $user->id)->get();
            $userAddresses['companyAddress'] = UserCompany::where('user_id', $user->id)->selectRaw('user_companies .*, company_name as name')->get();
            if (!empty($userAddresses)) {
                return new UserAddressCollection($userAddresses);
            } else {
                return response()->json([
                    'message' => __('apiMessage.dataNotExist'),
                ]);
            }
        } else {
            return response()->json(['error' => __('apiMessage.unauthorized')], 400);
        }
    }

    public function deleteAddress(UserAddress $address): JsonResponse
    {
        $address->delete();
        return response()->json([
            'message'=>__('apiMessage.addressDeleted'),
            'status'=> 'success'
        ]);
    }

    public function getAddressDetail(Request $request)
    {
        $address_id = $request->id;
        $addressDetail = UserAddress::where('id', $address_id)->with('city:id,name', 'state:id,name', 'country:id,name')->get();
        if (!empty($addressDetail)) {
            return new UserAddressCollection($addressDetail);
        } else {
              return response()->json(['message' => __('apiMessage.notExist')]);
          }
    }
}
