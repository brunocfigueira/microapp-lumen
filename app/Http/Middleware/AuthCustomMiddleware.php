<?php

namespace App\Http\Middleware;

use Closure;
use \Illuminate\Http\Request;
use \App\Http\IHttpCode;
use \Firebase\JWT\JWT;
use App\Services\UserService;

class AuthCustomMiddleware implements IHttpCode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            // check header Authorization or Bearer token
            if ($request->hasHeader('Authorization') == false || $request->bearerToken() == false) {
                return responder()->error('unauthorized')->respond($this::COD_UNAUTHORIZED);
            }
            $dataAuthorization = JWT::decode($request->bearerToken(), env('JWT_KEY'), ['HS256']);
            $userService = new UserService(\App\Models\Pgsql\Users::class);
            $user = $userService->findByLogin($dataAuthorization->login);
            if (is_null($user)) {
                return responder()->error('unauthorized')->respond($this::COD_UNAUTHORIZED);
            }
            return $next($request);
        } catch (\Exception $e) {
            return responder()->error('unauthorized')->respond($this::COD_UNAUTHORIZED);
        }
    }
}
