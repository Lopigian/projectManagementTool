<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class ApiHttpResponse extends JsonResponse
{
    public function __construct(mixed $data, string $message = 'Success', int $statusCode = 200)
    {
        $response = [
            'status' => $statusCode >= 200 && $statusCode < 300 ? 'success' : 'error',
            'message' => $message,
            'data' => $data,
        ];

        parent::__construct($response, $statusCode);
    }
}
