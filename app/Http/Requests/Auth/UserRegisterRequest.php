<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\JsonResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    use JsonResponseTrait;
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
            'username' => ['required', 'alpha_dash', 'min:4', 'max:20', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6'],
            'gender' => ['required', 'in:male,female,other'],
            'birthday' => ['required', 'date', 'date_format:Y-m-d']
        ];
    }
}
