<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'firstname' => 'required|string|min:3|max:20',

            'lastname' =>'required|string|min:3|max:20',

            'email' => 'required|email|max:255',
            
            'password' => 'required|string|min:8|regex:/^(?=.*?[a-z])(?=.*?[0-9]).{8,}$/',

            'confirm' => 'same:password',
            
            'phone' => 'required|integer',
        ];
    }
}
