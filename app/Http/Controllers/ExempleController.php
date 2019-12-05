<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiBaseController;

class ExempleController extends ApiBaseController
{
    public function __construct()
    {
        parent::__construct(\App\Services\ExempleService::class, trans('exemples'));        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Flugg\Responder
     */
    public function create()
    {
        // TO-DO - used for show form create
        dd('implements here the view form create');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Flugg\Responder
     */
    public function edit(Request $request, int $id)
    {
        // TO-DO - used for show form edit
        dd("implements here the view form edit for id: {$id}");
    }
    /**
     * Show the form for searching a resource.
     * @var $request Request
     * @return Flugg\Responder
     */
    public function search(Request $request)
    {        
        //call method (optional)
        //$this->executeValidate($request, (array) $this->rules, [],[]);
        return $this->service->search($request);
    }
}
