<?php

namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait FormValidation {
    protected function failedValidation(Validator $validator) {
        $response = ['message' => 'An error has occurred'];
        $response['errors'] = $validator->errors();

        throw new HttpResponseException(response()->json($response, 422));
    }
}
