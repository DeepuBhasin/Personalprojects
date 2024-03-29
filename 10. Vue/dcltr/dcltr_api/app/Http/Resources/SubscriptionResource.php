<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'plan_id' => $this->razorpay_plan_id,
            'name' => $this->name,
            'amount' => $this->amount,
            'no_of_leads' => $this->no_of_leads,
            'is_lead_carried_over' => $this->is_lead_carry_over,
            'days' => $this->days,
            'added_by' => $this->added_by,
            'is_selected'=> $this->userPlans()->where('user_id',auth()->user()->id)->count()?true:false,
            'is_enable' => ($this->status == 1)?true:false,
        ];
    }
}
