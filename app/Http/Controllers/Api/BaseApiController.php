<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiHttpResponse;

class BaseApiController extends Controller
{
    protected ApiHttpResponse $response;

    public function defaultResponse(mixed $data): ApiHttpResponse
    {
        return new ApiHttpResponse($data);
    }

}
