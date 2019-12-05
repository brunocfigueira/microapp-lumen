<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use \App\Services\BaseServiceAbstract;
use App\Http\Traits\MessagesTraits as Messages;
use App\Http\IHttpCode;
use Illuminate\Http\Request;
use Exception;

abstract class ApiBaseController extends BaseController implements IHttpCode
{

    use Messages;
    /**
     * String Class Entity Service
     * @class \App\Services\BaseServiceAbstract
     */
    protected $service;
    /**
     * @var $rules array 
     */
    protected $rules;
    /**
     * @var $lang array 
     */
    protected $customAttributes;
    /**
     * __construct
     */
    public function __construct($class, array $customAttributes = [])
    {
        // validate class
        $this->checkExistsServiceEntity($class);
        $this->service = new $class;
        $this->rules = (array) $class::rules();
        $this->customAttributes = $customAttributes;
    }
    private function checkExistsServiceEntity($class): bool
    {
        // Check to see whether the include declared the class
        if (class_exists($class) == false) {
            throw new Exception(trans('exceptions.unable_load_class', ['class' => 'ApiBaseController', 'value' => $class]));
        }
        if (is_subclass_of($class, BaseServiceAbstract::class) == false) {
            throw new Exception(trans('exceptions.not_extension_baseservice', ['class' => 'ApiBaseController', 'value' => $class]));
        }
        return true;
    }
    /**
     * set
     */
    public function setServiceEntity(object $class)
    {
        // validate class
        $this->checkExistsServiceEntity($class);
        $this->service = $class;
    }
    /**
     * get
     */
    public function getServiceEntity(): object
    {
        return $this->service;
    }
    /**
     * set
     */
    public function setRules(array $rules = [])
    {
        $this->rules = $rules;
    }
    /**
     * get
     */
    public function getRules(): array
    {
        return (array) $this->rules;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Flugg\Responder
     */
    abstract public function create();
    /**
     * Show the form for editing a resource.
     *
     * @return Flugg\Responder
     */
    abstract public function edit(Request $request, int $id);
    /**
     * Show the form for searching a resource.
     *
     * @return Flugg\Responder
     */
    abstract public function search(Request $request);
    /**              
     * for use validate with translator:
     * $customAttributes - file into resources/lang/pt_BR/     
     */
    protected function executeValidate(Request $request, array $rules, array $messages = [], array $customAttributes = [])
    {
        return $this->validate($request, $rules, $messages, $customAttributes);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Flugg\Responder
     */
    public function index(Request $request)
    {
        /**         
         * $request->per_page - the field indicate the numeber pages. if null get value default of Model         
         */
        $perPage = $request->has('per_page') ? (int) $request->per_page : null;
        $records = $this->service->findByPaginate($perPage);
        return responder()->success(['records' => $records])->respond($this::COD_REQUEST_SUCCESS);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Flugg\Responder
     */
    public function store(Request $request)
    {
        if (empty($this->customAttributes)) {
            $this->executeValidate($request, (array) $this->rules);
        } else {
            $this->executeValidate($request, (array) $this->rules, [], (array) $this->customAttributes);
        }
        try {
            $record = $this->service->store($request);
            $message = $this->msgSuccessStored();
            return responder()->success(['message' => $message, 'record' => $record])->respond($this::COD_CREATE_SUCCESS);
        } catch (Exception $e) {
            return responder()->error('store_failed')->respond($this::COD_CONFLICT);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Exemple  $record
     * @return Flugg\Responder
     */
    public function show(int $id)
    {
        try {
            $record = $this->service->findById($id);
            return responder()->success(['record' => $record])->respond($this::COD_REQUEST_SUCCESS);
        } catch (Exception $e) {
            return responder()->error('resource_not_found')->respond($this::COD_NOT_FOUND);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return Flugg\Responder
     */
    public function update(Request $request, int $id)
    {
        if (empty($this->customAttributes)) {
            $this->executeValidate($request, (array) $this->rules);
        } else {
            $this->executeValidate($request, (array) $this->rules, [], (array) $this->customAttributes);
        }
        try {
            $record = $this->service->update($request, $id);
            $message = $this->msgSuccessUpdated();
            return responder()->success(['message' => $message, 'record' => $record])->respond($this::COD_UPDATE_SUCCESS);
        } catch (Exception $e) {
            return responder()->error('resource_not_found')->respond($this::COD_NOT_FOUND);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exemple  $record
     * @return Flugg\Responder
     */
    public function destroy(int $id)
    {
        try {
            $this->service->destroy($id);
            $message = $this->msgSuccessDeleted();
            return responder()->success(['message' => $message])->respond($this::COD_REQUEST_SUCCESS);
        } catch (Exception $e) {
            return responder()->error('resource_not_found')->respond($this::COD_NOT_FOUND);
        }
    }
}
