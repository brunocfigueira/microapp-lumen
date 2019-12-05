<?php

namespace App\Models\Pgsql;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Exemples extends Model
{
    /**
     * attr connection
     * @var string
     */
    protected $connection = 'pgsql';
    /**
     * @var string
     */
    protected $table = 'exemples';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description'
    ];
    /**
     * attr perPage used in paginate
     * @var int
     */
    protected $perPage = 15; // value default lumen
    /**
     * attr appends used for add fiels that not exists mapping in table
     */
    protected $appends = ['links'];
    /**
     * Method accessor
     */
    public function getLinksAttribute($link): array
    {
        return [
            'self' => Str::replaceFirst('{id:[0-9]+}', $this->id, route('api.v1.exemples.show')),
        ];
    }
}
