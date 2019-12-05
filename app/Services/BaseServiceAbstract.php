<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Exception;

abstract class BaseServiceAbstract implements IBaseService
{
    /**
     * String Class Entity Model
     */
    protected $model;
    /**
     * @var typesDirection array
     */
    protected $typesDirection = ['asc','desc'];
    /**
     * __construct
     */
    public function __construct($class)
    {
        // validate class
        $this->checkExistsModelEntity($class);
        $this->model = $class;
    }
    private function checkExistsModelEntity($class): bool
    {
        // Check to see whether the include declared the class
        if (class_exists($class) == false) {
            throw new Exception(trans('exceptions.unable_load_class', ['class' => 'BaseServiceAbstract', 'value' => $class]));
        }
        if (is_subclass_of($class, Model::class) == false) {
            throw new Exception(trans('exceptions.not_extension_eloquent', ['class' => 'BaseServiceAbstract', 'value' => $class]));
        }
        return true;
    }
    /**
     * set
     */
    public function setModelEntity($class)
    {
        // validate class
        $this->checkExistsModelEntity($class);
        $this->model = $class;
    }
    /**
     * get
     */
    public function getModelEntity()
    {
        return $this->model;
    }
    /**
     * list by paginate
     */
    public function findByPaginate(int $perPage = null)
    {
        // TODO: Implement findAll() method.
        return $this->model::paginate($perPage);
    }
    /**
     * list all records
     */
    public function findAll()
    {
        // TODO: Implement findAll() method.
        return $this->model::all();
    }
    /**
     * find unique record
     * @param type int $id
     * @return type Collection
     */
    public function findById(int $id)
    {
        // TODO: Implement findById() method.
        return $this->model::findOrFail($id);        
    }
    /**
     * remove unique record
     * @param type int $id
     */
    public function destroy(int $id)
    {
        // TODO: Implement delete() method.
        return $this->findById($id)->delete();
    }
    /**
     * save data request
     * @param type Request $request
     * @return type int $id
     */
    public function store(Request $request)
    {
        // TODO: Implement store() method.
        return $this->model::create($request->all());
    }
    /**
     * alter data request
     * @param type Request $request
     * @param type int $id
     * @return type int $id
     */
    public function update(Request $request, int $id)
    {
        $this->findById($id)->update($request->all());
        return $this->findById($id);
    }
    /**
     * search data request
     * @param type Request $request
     * @return type mixed
     */
    abstract public function search(Request $request);
    /**
     * check exists record
     * @param type int $id
     * @return type boolean
     */
    public function exists(int $id)
    {
        // TODO: Implement exists() method.
        return $this->model::where('id', $id)->exists();
    }

    /**
     * Convert value to decimal data base
     * Ex. Request = 19,90 pt_BR
     *     Convert = 19.90 en_US
     * @param type string $value
     * @return type double
     */
    public function convertDecimalValue(string $value)
    {
        $value = str_replace('.', '', $value);
        $value = str_replace(',', '.', $value);
        return (float) $value;
    }

    public function convertSpecialCharacters(string $value)
    {
        return htmlentities(htmlspecialchars($value));
    }
    public function escapeCharactersString(string $value)
    {
        return mysql_escape($value);
    }
    /**
     *
     */
    public function makeHashFile(string $value, string $extension = 'pdf')
    {
        if (is_null($value)) {
            return $value;
        }
        return md5(uniqid($value)) . '.' . $extension; // md5+uniqid = 32 characteres + length extension
    }
}
