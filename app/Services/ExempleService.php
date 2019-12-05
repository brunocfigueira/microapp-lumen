<?php

namespace App\Services;

use App\Services\BaseServiceAbstract;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class ExempleService extends BaseServiceAbstract
{

    /**
     * validation rules business for fields of table
     * @var array
     */
    private static $rules = [
        'name' => 'required|max:250',
        'description' => 'required|max:1000',
    ];
    /**
     * method static access for rules
     */
    public static function rules()
    {
        return self::$rules;
    }
    /**
     * __construct
     */
    public function __construct()
    {
        parent::__construct(\App\Models\Pgsql\Exemples::class);
    }

    /**
     * search data request
     * @param type Request $request
     * @return type mixed
     */
    public function search(Request $request)
    {
        /*
         format POST request expected
          {
                "field_1":"a text to be search",
                "field_2":"a text to be search",
                "field_3":"a text to be search",
                "field_n":"a text to be search",                
                "order_by_columns":{
                    "field_1":"asc or desc",                    
                    "field_2":"asc or desc",                    
                    "field_3":"asc or desc",                    
                    "field_n":"asc or desc",                    
                },
                "per_page":"int value"
                    
            } 
         */
        // TODO: Implement search() method.    
        // query search
        $query = $this->model::query()
            ->where(function ($q) use ($request) {

                if ($request->has('id')) {
                    $q->orWhereRaw("exemples.id like '{$request->id}'");
                }
                if ($request->has('name')) {
                    $q->orWhereRaw("LOWER(exemples.name) like LOWER('%{$request->name}%')");
                }
                if ($request->has('description')) {
                    $q->orWhereRaw("LOWER(exemples.description) like LOWER('%{$request->description}%')");
                }
            });
        // order_by_columns - check exists
        if ($request->has('order_by_columns') && \is_array($request->order_by_columns)) {
            foreach ($request->order_by_columns as $column => $direction) {
                $column = Str::lower($column);
                $direction = Str::lower($direction);
                $direction = Arr::has($this->typesDirection, $direction) ? $direction : "asc";
                $query->orderBy($column, $direction);
            }
        }else{
            // default orderBy
            $query->orderBy('id');
        }
        //pagination
        $perPage = $request->has('per_page') ? (int) $request->per_page : null;        
        // debug query
        //dd($query->toSql());
        return $query->paginate($perPage);
    }
}
