<?php

namespace App\Models\Oracle;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $connection = 'oracle';
    /**
     * @var string
     */
    protected $table = 'DBSIAF.ALUNO';
    /**
     * @var string
     */
    protected $primaryKey = 'COD_ALUNO';
    /**
     * @var array
     */
    protected $hidden = ['COD_USUARIO_LOG', 'DAT_OPERACAO_LOG'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       // 'NAME', 'DESCRIPTION'
    ];

    /**
     * @var boolean
     */
    public $timestamps = false;
}
