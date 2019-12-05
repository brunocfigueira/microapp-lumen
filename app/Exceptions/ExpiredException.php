<?php

namespace App\Exceptions;

use Flugg\Responder\Exceptions\Http\HttpException;
use App\Http\IHttpCode;

class ExpiredException extends HttpException implements IHttpCode
{

    /**
     * The error code.
     *
     * @var string|null
     */
    protected $errorCode = 'expired_token';
    /**
     * Retrieve the HTTP status code,
     *
     * @return int
     */
    public function statusCode(): int
    {
        return $this::COD_UNAUTHORIZED;
    }
    /**
     * Retrieve the error message.
     *
     * @return string|null
     */
    public function message()
    {
        return trans('exceptions.expired_token');
    }
}
