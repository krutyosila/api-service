<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PasswordUpdateRequest;
use App\Services\User\UserService;
use Illuminate\Http\JsonResponse;

/**
 * Class UserController
 * @package App\Http\Controllers\User
 */
class UserController extends Controller
{

    /**
     * @var UserService
     */
    private $userService;

    /**
     * AuthController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return JsonResponse
     */
    public function me()
    {
        $result = $this->userService->user();
        return $this->response($result);
    }

    public function updatePassword(PasswordUpdateRequest $passwordUpdateRequest)
    {
        $result = $this->userService->updatePassword($passwordUpdateRequest);
        return $this->response($result);
    }
}
