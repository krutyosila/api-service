<?php

namespace App\Http\Traits;

use App\Types\ApiResponseType;
use Illuminate\Http\JsonResponse;

/**
 * Class ApiResponse
 * @package App\Http\Controllers\Auth
 */
trait ApiResponse
{
    /**
     * @param ApiResponseType $apiResponseType
     * @return JsonResponse
     */
    public function response(ApiResponseType $apiResponseType)
    {
        return response()->json($apiResponseType);
    }
}
