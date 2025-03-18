<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgencyOptionRequest extends FormRequest
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
            'option_id' => 'required|integer|min:1|max:3',
            'nop' => 'required|integer|min:1',
            'price' => 'required|integer'
        ];
    }
    public function messages()
    
    {
        return [
            'nop.required' => 'N° of Option is required',
            'nop.min' => 'Option must at least 1',
        ];
    }
}
