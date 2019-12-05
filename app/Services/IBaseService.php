<?php

namespace App\Services;

use Illuminate\Http\Request;


interface IBaseService
{

    /**
     * list by paginate
     */
    public function findByPaginate(int $perPage = null);
    /**
     * list all records
     */
    public function findAll();
    /**
     * get unique record
     * @param type int $id
     * @return type Collection
     */
    public function findById(int $id);
    /**
     * remove unique record
     * @param type int $id
     */
    public function destroy(int $id);
    /**
     * save data request
     * @param type Request $request
     * @return type int $id
     */
    public function store(Request $request);
    /**
     * alter data request
     * @param type Request $request
     * @param type int $id
     * @return type int $id
     */
    public function update(Request $request, int $id);
    /**
     * search data request
     * @param type Request $request
     * @return type mixed
     */
    public function search(Request $request);
    
    /**
     * check exists record
     * @param type int $id
     * @return type boolean
     */
    public function exists(int $id);    
}
