<?php

namespace App\Http\Requests\User;

use App\Traits\FormValidation;
use Illuminate\Foundation\Http\FormRequest;

class SignInUser extends FormRequest
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
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|max:20|min:6'
        ];
    }
}
