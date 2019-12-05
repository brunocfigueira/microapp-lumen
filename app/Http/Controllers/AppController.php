<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use \Firebase\JWT\JWT;
use Illuminate\Support\Facades\Hash;
use App\Http\IHttpCode;

class AppController extends Controller implements IHttpCode
{
    private $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getVersion()
    {
        if (app()->environment('local')) {
            return responder()->success(['version' => app()->version()])->respond(200);
        } else {
            return responder()->error('403')->respond(403);
        }
    }
    public function getKey()
    {
        if (app()->environment('local')) {
            return responder()->success(['APP_KEY' => \Illuminate\Support\Str::random(32)])->respond(200);
        } else {
            return responder()->error('403')->respond(403);
        }
    }
    public function getJwtKey()
    {
        if (app()->environment('local')) {
            $jwtKey = \Illuminate\Support\Str::random(10) . '@' . rand(1, 9999);           
            return responder()->success(['JWT_KEY' => $jwtKey])->respond(200);
        } else {
            return responder()->error('403')->respond(403);
        }
    }
    /**
     * Generate a new resource (token)
     *
     * @return Flugg\Responder
     */
    public function generateAccessToken(Request $request)
    {
        // check data request
        $this->validate($request, [
            'login' => 'required',
            'password' => 'required',
        ]);

        $user = $this->userService->findByLogin($request->login);
        if (is_null($user) || Hash::check($request->password, $user->password) == false) {
            return responder()->error('validation_user_password_failed')->respond($this::COD_UNAUTHORIZED);
        }

        $token = JWT::encode([
            'login' => $request->login,
            'password' => $request->password,
        ], env('JWT_KEY'));
        return responder()->success([
            'header' => 'Authorization',
            'token_type' => 'Bearer',
            'access_token' => $token
        ])->respond($this::COD_REQUEST_SUCCESS);
    }
}
