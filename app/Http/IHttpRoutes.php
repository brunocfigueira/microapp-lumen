<?php

namespace App\Http;

interface IHttpRoutes
{
    /**
     * For URIs exceptions - used in authenticate
     * @var const EXCEPT array
     */
    const ROUTES_EXCEPT = [
        'app/version',
        'app/key',
        'app/jwt/key',
        'app/access/token',
    ];
}
