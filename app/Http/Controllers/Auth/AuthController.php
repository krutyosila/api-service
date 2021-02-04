<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserLoginRequest;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\JsonResponse;

/**
 * Class AuthController
 * @package App\Http\Controllers\Auth
 */
class AuthController extends Controller
{

    /**
     * @var AuthService
     */
    private $authService;

    /**
     * AuthController constructor.
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @param UserRegisterRequest $request
     * @return JsonResponse
     */
    public function register(UserRegisterRequest $request)
    {
        $result = $this->authService->register($request);
        return $this->response($result);
    }

    /**
     * @param UserLoginRequest $request
     * @return JsonResponse
     */
    public function login(UserLoginRequest $request)
    {
        $result = $this->authService->login($request);
        return $this->response($result);
    }

    /**
     * @return JsonResponse
     */
    public function logout()
    {
        $result = $this->authService->logout();
        return $this->response($result);
    }
}
