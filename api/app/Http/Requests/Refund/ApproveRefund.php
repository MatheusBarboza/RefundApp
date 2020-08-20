<?php

namespace App\Http\Requests\Refund;

use App\Traits\FormValidation;
use Illuminate\Foundation\Http\FormRequest;

class ApproveRefund extends FormRequest
{
    use FormValidation;
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->isManager();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'status' => 'required|numeric|between:1,2'
        ];
    }

    public function messages()
    {
        return [
            'status' => 'The status is invalid'
        ];
    }
}
