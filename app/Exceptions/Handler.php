<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Flugg\Responder\Exceptions\Handler as ExceptionHandler;
use Flugg\Responder\Exceptions\Http\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Flugg\Responder\Exceptions\Http\PageNotFoundException;
use \Firebase\JWT\SignatureInvalidException;
use \Firebase\JWT\ExpiredException;
use \App\Exceptions\SignatureInvalidException as SignatureException;
use \App\Exceptions\ExpiredException as ExpiredTokenException;

class Handler extends ExceptionHandler
{

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function render($request, Exception $exception)
    {
        
        $this->convertDefaultException($exception);
        $this->convert($exception, [
            MethodNotAllowedHttpException::class => PageNotFoundException::class,
            SignatureInvalidException::class => SignatureException::class,
            ExpiredException::class => ExpiredTokenException::class,
        ]);

        if ($exception instanceof HttpException) {
            return $this->renderResponse($exception);
        }
        return parent::render($request, $exception);
    }
}
