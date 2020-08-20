<?php

namespace App\Http\Requests\Expense;

use App\Traits\FormValidation;
use Illuminate\Foundation\Http\FormRequest;

class StoreExpense extends FormRequest
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
            'name' => 'required|string|max:30|min:3|unique:expenses',
        ];
    }
}
