<?php

namespace App\Http\Requests;

use App\Types\ApiResponseType;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

trait JsonResponseTrait
{
    public function failedValidation(Validator $validator)
    {
        if ($this->wantsJson() || $this->ajax()) {
            $response = new ApiResponseType();
            $response->setStatus(false);
            $response->setData($validator->errors()->toArray());
            throw new HttpResponseException(response()->json($response, 200));
        }
        parent::failedValidation($validator);
    }
}
