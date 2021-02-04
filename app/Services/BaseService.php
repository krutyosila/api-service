<?php

namespace App\Services;

use App\Types\ApiResponseType;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseService
 * @package App\Services
 */
class BaseService
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @var ApiResponseType
     */
    public $response;

    /**
     * AuthService constructor.
     * @param ApiResponseType $apiResponseType
     */
    public function __construct(ApiResponseType $apiResponseType)
    {
        $this->response = $apiResponseType;
    }
}
