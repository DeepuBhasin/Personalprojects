<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Campaign;
use App\Models\CampaignCity;
use App\Models\CompaignData;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CompaignDataRequest;
use App\Http\Requests\Admin\CreateCampaign;
use App\Http\Resources\CompaignCityResource;
use App\Http\Resources\Admin\CampaignResource;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Campaign $campaign)
    {
        $campaign = $campaign->newQuery();
        if ($request->has('title')) {
            $campaign->where('title', 'like', '%' . $request->input('title') . '%');
        }
        $campaign->whereDate('start_date', '>=', Carbon::now())
            ->whereDate('end_date', '>=', Carbon::now())
            ->with('cities.cityName');
        $data = $campaign->orderBy('order_no')->get();
        return new CampaignResource($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCampaign $request)
    {
        $input = $request->validated();
        $image = $request->file('image');
        $uploadFolder = 'campaign';
        $imageUploadedPath = $image->store($uploadFolder, 'public');
        $input['image'] = $uploadFolder."/". basename($imageUploadedPath);
        $campaign = Campaign::create($input + ['admin_id' => auth()->id()]);

        foreach ($input['cities'] as $cityId) {
            CampaignCity::create([
                'city_id' => $cityId,
                'campaign_id' => $campaign->id
            ]);
        }

        return response()->json([
            'message'=>__('apiMessage.createCampaign'),
            'status'=> 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        return new CampaignResource($campaign->load('cities.cityName.state:id,name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCampaign $request, Campaign $campaign)
    {
        $input = $request->validated();
        if ($request->file('image')) {
            unlink(storage_path('app/public/' . $campaign->image));
            $image = $request->file('image');
            $uploadFolder = 'campaign';
            $imageUploadedPath = $image->store($uploadFolder, 'public');
            $input['image'] = $uploadFolder."/". basename($imageUploadedPath);
        }

        $campaign->update($input);

        if (!empty($input['cities'])) {
            CampaignCity::where('campaign_id', $campaign->id)->delete();
            foreach ($input['cities'] as $cityId) {
                CampaignCity::create([
                    'city_id' => $cityId,
                    'campaign_id' => $campaign->id
                ]);
            }
        }

        return response()->json([
            'message'=>__('apiMessage.updateCampaign'),
            'status'=> 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        $campaign->delete();
        unlink(storage_path('app/public/' . $campaign->image));
        return response()->json([
            'message'=>__('apiMessage.deleteCampaign'),
            'status'=> 'success'
        ]);
    }

    public function getPromotionalCampaignData(Request $request)
    {
        $campaign_id = $request->id;
        if (!empty($campaign_id)) {
            $data = Campaign::with('cities')
            ->where('id', $campaign_id)
            ->get();
            if (!empty($data)){
            return new CampaignResource($data);
            }
            else{
                return response()->json(['message' => __('apiMessage.campaignNotExist')]);
            }
        } else {
            return response()->json([
               'message'=>__('apiMessage.errorMsg'),
            ]);
        }
    }

    public function getPromotionalCampaigns(Request $request)
    {
        $city_id = $request->city_id;
        $cityName = City::find($city_id)->name;
        if (!empty($city_id)) {
            $data = Campaign::whereIn('id', CampaignCity::where('city_id', $city_id)
                ->pluck('campaign_id'))
                ->get()->map(function ($item) use ($cityName) {
                    $item['city_name'] = $cityName;
                    return $item;
                });
            if (!empty($data)){
                return new CompaignCityResource($data);
            }
            else{
                return response()->json(['message' => __('apiMessage.notExist')]);
            }
        } else {
            return response()->json([
               'message'=>__('apiMessage.errorMsg'),
            ]);
        }
    }

    public function updateStatus(Campaign $campaign)
    {
        if ($campaign->is_active == 1) {
            $campaign->is_active = 0;
            $campaign->save();
            return response()->json([
                'message'=>__('apiMessage.campaignInactive'),
                'status'=> 'success'
            ]);

        } else {
            $campaign->is_active = 1;
            $campaign->save();
            return response()->json([
                'message'=>__('apiMessage.campaignActive'),
                'status'=> 'success'
            ]);
        }
    }

    public function saveCampaignData(CompaignDataRequest $request)
    {
        $user = auth()->user();
        if (!empty($user)) {
            $compaignDataSubmitted = CompaignData::create([
                'compaign_id' => $request->compaign_id,
                'address_id' => $request->address_id,
                'user_id' => $user->id
            ]);
            $dataToBeUpdate = [];
            $description = $request->description ?? '';
            if (!empty($description)) {
                $dataToBeUpdate['description'] = $description;
            }
            $quantity = $request->quantity ?? '';
            if (!empty($quantity)) {
                $dataToBeUpdate['quantity'] = $quantity;
            }
            CompaignData::where('id', $compaignDataSubmitted['id'])->update($dataToBeUpdate);
            if ($compaignDataSubmitted) {
                return response()->json([
                    'message' => __('apiMessage.compaignDataSubmitted'),
                    'status' => 'success'
                ]);
            } else {
                return response()->json(['message' => __('apiMessage.errorMsg')]);
            }
        } else {
            return response()->json([
                'message'=>__('apiMessage.unauthorized'),
                'status'=> 'error'
            ]);
        }
    }

    public function reordringlocation(Request $request) {
        $i = 0;
        foreach ($request->campaignIds as $campaignId) {
            $i++;
            Campaign::where('id', $campaignId)->update([
                'order_no' => $i
            ]);
        }
        return response()->json([
            'message'=>__('apiMessage.campaignReorded'),
            'status'=> 'success'
        ]);
    }

    public function pastCampaigns(Request $request, Campaign $campaign)
    {
        $perPage = ($request->per_page) ? $request->per_page : 10;
        $campaign = $campaign->newQuery();
        if ($request->has('title')) {
            $campaign->where('title', 'like', '%' . $request->input('title') . '%');
        }
        $campaign->whereDate('start_date', '<', Carbon::now())
            ->with('cities.cityName');
        $data = $campaign->orderBy('order_no')->paginate($perPage);
        return CampaignResource::collection($data);
    }

    public function reordringlocationAfterSearch(Request $request) {

        $data = json_decode($request->campaign,true);
        foreach($data as $campaign) {
            Campaign::where('id', $campaign['id'])->update(['order_no' => $campaign['order_no']]);
        }
        return response()->json([
            'message'=>__('apiMessage.campaignReorded'),
            'status'=> 'success'
        ]);
    }
}
