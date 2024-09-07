<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
class HttpHasMatchException extends HttpException
{
    public function __construct(string $message = "")
    {
        parent::__construct(HttpResponse::HTTP_CONFLICT, $message);
    }
}
