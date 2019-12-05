<?php

namespace App\Models\Oracle;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Exemples extends Model
{
    protected $connection = 'oracle';
    /**
     * @var string
     */
    protected $table = 'dbsiaf.exemples';
    /**
     * @var string
     */
    protected $primaryKey = 'cod_exemple';
    /**
     * @var array
     */
    protected $hidden = ['cod_usuario_log', 'dat_operacao_log'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description'
    ];

    /**
     * @var boolean
     */
    public $timestamps = false;

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
    public function getLinksAttribute($link): array {
        return [
            'self'=> Str::replaceFirst('{id:[0-9]+}',$this->id,route('api.v1.exemples.show')),
        ];
    }
}
