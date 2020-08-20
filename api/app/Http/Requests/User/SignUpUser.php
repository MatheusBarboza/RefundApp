<?php

namespace App\Http\Requests\User;

use App\Traits\FormValidation;
use Illuminate\Foundation\Http\FormRequest;

class SignUpUser extends FormRequest
{
    use FormValidation;
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
            'name'     => 'required|string|max:30|min:3',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|max:20|min:6|confirmed',
            'role'     => 'required|numeric|between:0,1'
        ];
    }

}
