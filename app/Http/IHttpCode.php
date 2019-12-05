<?php

namespace App\Http;

interface IHttpCode
{
    /**
     * Constants - Codes response http
     */
    const COD_REQUEST_SUCCESS = 200; //requisição foi bem sucedida
    const COD_CREATE_SUCCESS = 201; //new feature was successfully created
    const COD_UPDATE_SUCCESS = 201; //a feature was successfully updated
    const COD_DELETE_SUCCESS = 204; //a feature was successfully removed
    const COD_UNAUTHORIZED = 401; // unauthorized
    const COD_NOT_FOUND = 404; //resource not found
    const COD_CONFLICT = 409; //resource not found, exception by conflict
}
