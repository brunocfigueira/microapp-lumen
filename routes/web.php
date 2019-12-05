<?php

//ROUTES TO USE WITHOUT AUTH
$router->group(['prefix' => 'app', 'as' => 'app'], function () use ($router) {
    //ROUTE TO APP VERSION LUMEN
    $router->get('version', ['uses' => 'AppController@getVersion', 'as' => 'getVersion']);
    //ROUTE TO KEY GENERATE ONLY 'LOCAL' FOR APP_KEY FILE .ENV
    $router->get('key', ['uses' => 'AppController@getKey', 'as' => 'getKey']);
    // ROUTE TO JWT KEY
    $router->get('jwt/key[/{prefix}]', ['uses' => 'AppController@getJwtKey', 'as' => 'getJwtKey']);
    //ROUTE FOR GENERATE TOKEN
    $router->post('access/token', ['uses' => 'AppController@generateAccessToken', 'as' => 'generateAccessToken']);
});
/**
 * DEFAULT METHODS TO ROUTE RECOMMENDED FOR DEV APIs
 * 
 *  $router->get('/exemples', ['uses' => 'ExempleController@index', 'as' => 'exemples.index']);
 *  $router->post('/exemples', ['uses' => 'ExempleController@store', 'as' => 'exemples.store']);
 *  $router->get('/exemples/{id:[0-9]+}', ['uses' => 'ExempleController@show', 'as' => 'exemples.show']);
 *  $router->put('/exemples/{id:[0-9]+}', ['uses' => 'ExempleController@update', 'as' => 'exemples.update']);
 *  $router->delete('/exemples/{id:[0-9]+}', ['uses' => 'ExempleController@destroy', 'as' => 'exemples.destroy']);
 */
//ROUTE GROUP TO API
$router->group(['prefix' => 'api', 'as' => 'api', 'middleware' => 'auth'], function () use ($router) {
    //ROUTE GROUP TO API V1 
    $router->group(['prefix' => 'v1', 'as' => 'v1'], function () use ($router) {
       //ROUTE TO CRUD EXEMPLES
        $router->get('/exemples', ['uses' => 'ExempleController@index', 'as' => 'exemples.index']);
        $router->post('/exemples', ['uses' => 'ExempleController@store', 'as' => 'exemples.store']);
        $router->get('/exemples/{id:[0-9]+}', ['uses' => 'ExempleController@show', 'as' => 'exemples.show']);
        $router->put('/exemples/{id:[0-9]+}', ['uses' => 'ExempleController@update', 'as' => 'exemples.update']);
        $router->delete('/exemples/{id:[0-9]+}', ['uses' => 'ExempleController@destroy', 'as' => 'exemples.destroy']);
        // (ROUTES OPTIONAL)
        $router->get('/exemples/create', ['uses' => 'ExempleController@create', 'as' => 'exemples.create']);
        $router->get('/exemples/{id:[0-9]+}/edit', ['uses' => 'ExempleController@edit', 'as' => 'exemples.edit']);
        $router->post('/exemples/search', ['uses' => 'ExempleController@search', 'as' => 'exemples.search']);
    });
    //ROUTE GROUP TO API V2 
    $router->group(['prefix' => 'v2', 'as' => 'v2'], function () use ($router) { });
});
