<?php

namespace App\Http\Requests\Refund;

use App\Traits\FormValidation;
use Illuminate\Foundation\Http\FormRequest;

class StoreRefund extends FormRequest
{
    use FormValidation;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->isEmployer();
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
            'price'    => 'required|numeric|between:0.01,999999.99|regex:/^\d*(\.\d{1,2})?$/',
            'expenses' => 'required'
        ];
    }
}
