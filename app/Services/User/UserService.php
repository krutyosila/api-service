<?php

namespace App\Services\User;

use App\Http\Requests\User\PasswordUpdateRequest;
use App\Services\BaseService;
use App\Types\ApiResponseType;
use App\Types\UserType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserService
 * @package App\Services\User
 */
class UserService extends BaseService
{
    /**
     * @return ApiResponseType
     */
    public function user()
    {
        $user = request()->user();
        $this->response->setData([
            'id' => $user->id,
            'email' => $user->email,
            'username' => $user->username,
            'gender' => $user->gender,
            'birthday' => $user->birthday,
            'balance' => $user->wallet->balance,
        ]);
        return $this->response;
    }

    /**
     * @param PasswordUpdateRequest $passwordUpdateRequest
     * @return ApiResponseType
     */
    public function updatePassword(PasswordUpdateRequest $passwordUpdateRequest)
    {
        $user = Auth::user();
        $type = new UserType();
        $type->setPassword($passwordUpdateRequest->get('current_password'));
        if (!Hash::check($type->getPassword(), $user->password)) {
            $this->response->setStatus(false);
            $this->response->setMessage(trans('auth.password'));
            return $this->response;
        }
        $type->setPassword($passwordUpdateRequest->get('password'));
        $user->update($type->toArray());
        return $this->response;
    }
}
