<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\PetrolType;
use App\Enums\GearBox;

class StoreCarRequest extends FormRequest
{

    static public $rules = [

        'mark' => 'required|string|min:3|max:30',

        'model' =>'required|string|min:3|max:30',

        'consumption' =>'required|integer',

        'Kilometrage' =>'required|integer',

        'price' => 'required|integer',

        'gearbox' => ['required','enum_value:' . GearBox::class],

        'petrolType' => ['required','enum_value:' . PetrolType::class],

        'nofplaces' => 'required|integer',

        'photo' => 'required|file'
        
    ];

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
        return self::$rules;
    }

}
