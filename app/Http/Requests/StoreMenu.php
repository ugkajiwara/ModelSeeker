<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenu extends FormRequest
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
            //
            'menu_name' => 'required|string|max:100',
            'minutes' => 'required|',
            'charge' => 'required|integer|max:1000000',
            'requirements' => 'string|nullable|max:500',
        ];
    }
}
