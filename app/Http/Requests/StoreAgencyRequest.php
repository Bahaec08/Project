<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class StoreAgencyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'ag_name' => 'required|string|min:5|max:30',

            'owner_name' =>'required|string|min:5|max:30',

            'ag_phone' =>'required|unique:App\Models\Agency,phone',

            //'ag_phone' => 'regex:/^(\+?216|00216)?(9|5|2)\d{7}$/',

            'ag_email' =>'required|email|max:60|unique:App\Models\Agency,email',

            'ag_cars' => 'required',

            'location' => 'required',

        ];
    }
}
