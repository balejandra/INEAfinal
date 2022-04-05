<?php

namespace App\Models\Vageneral;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AgenciaNavieraVigente
 * @package App\Models
 * @version March 21, 2022, 5:49 pm UTC
 *
 * @property integer $vasolicitude_id
 * @property string $nomactv
 * @property string $rifemp
 * @property string $nomemp
 * @property string $vencimiento_permiso
 */
class AgenciaNavieraVigente extends Model
{

    use HasFactory;

    protected $connection = 'pgsql_vageneral_schema';
    public $table = 'agencias_navieras_vigentes';


    protected $primaryKey = 'vasolicitude_id';

    public $fillable = [
        'nomactv',
        'rifemp',
        'nomemp',
        'vencimiento_permiso'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'vasolicitude_id' => 'integer',
        'nomactv' => 'string',
        'rifemp' => 'string',
        'nomemp' => 'string',
        'vencimiento_permiso' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nomactv' => 'required',
        'rifemp' => 'required',
        'nomemp' => 'required',
        'vencimiento_permiso' => 'required'
    ];


}
