<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class StoreUser extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255',Rule::unique('users')->ignore(Auth::user()->id)],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
            'salon_name' => ['required', 'string', 'max:255'],
            'salon_address' => ['required', 'string', 'max:255'],
            'salon_tel' => ['required', 'string', 'max:15'],
            // 'is_subscribed' => [],
        ];
    }
}
