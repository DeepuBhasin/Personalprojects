<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateCampaign extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:admins,email',
            'title' => 'required|string',
            'type' => 'required|integer',
            'description' => 'required|string',
            'donation_limit' => 'required|integer',
            'company_name' => 'required|string',
            'company_address' => 'required|string',
            'image' => 'sometimes|required|image|mimes:png,jpg',
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date',
            'is_active' => 'required|boolean',
            'need_inspection' => 'required|boolean',
            'cities' => 'required|array',
            'set_background_image' => 'required|boolean',
        ];
    }
}
