<?php

namespace App\Services\Auth;

use App\Http\Requests\Auth\UserLoginRequest;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Models\User;
use App\Services\BaseService;
use App\Types\ApiResponseType;
use App\Types\UserType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * Class AuthService
 * @package App\Services\Auth
 */
class AuthService extends BaseService
{
    /**
     * @param User $user
     * @return array
     */
    public function getToken(User $user)
    {
        foreach ($user->tokens as $token) {
            $token->revoke();
        }
        return [
            'token' => $user->createToken(config('app.name'))->accessToken,
            'type' => 'Bearer',
            'expires_at' => Carbon::parse(Carbon::now()->addWeeks(1))->toDateTimeString()
        ];
    }

    /**
     * @return ApiResponseType
     */
    public function logout()
    {
        request()->user()->token()->revoke();
        return $this->response;
    }

    /**
     * @param UserRegisterRequest $request
     * @return ApiResponseType
     */
    public function register(UserRegisterRequest $request)
    {
        $type = new UserType();
        $type->arrayToType($request->all());
        try {
            $user = User::create($type->toArray());
            $user->wallet()->create();
            if (Auth::attempt($request->only('username', 'password'))) {
                $this->response->setData($this->getToken($user));
            }
        } catch (\Exception $e) {
            $this->response->setStatus(false);
            $this->response->setMessage($e->getMessage());
        }
        return $this->response;
    }

    /**
     * @param UserLoginRequest $request
     * @return ApiResponseType
     */
    public function login(UserLoginRequest $request)
    {
        $type = new UserType();
        $type->arrayToType($request->only('username', 'password'));
        try {
            if (Auth::attempt($request->only($this->username(), 'password'))) {
                $user = Auth::user();
                $this->response->setData($this->getToken($user));
                return $this->response;
            } else {
                $this->response->setStatus(false);
                $this->response->setMessage(trans('auth.failed'));
                return $this->response;
            }
        } catch (\Exception $e) {
            $this->response->setMessage($e->getMessage());
            return $this->response;
        }
    }

    /**
     * @return mixed
     */
    private function username()
    {
        $login = request()->get('username');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$field => $login]);
        return $field;
    }
}
