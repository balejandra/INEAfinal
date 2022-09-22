<?php

namespace App\Models\Zarpes;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class CertificadoObligatorio
 * @package App\Models
 * @version September 19, 2022, 8:00 pm -04
 *
 * @property string $parametro_embarcacion
 * @property string $operador_logico
 * @property string $cantidad_comparacion
 * @property string $nombre_certificado
 */
class CertificadoObligatorio extends Model  implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $connection = 'pgsql_zarpes_schema';
    public $table = 'certificados_obligatorios';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'parametro_embarcacion',
        'operador_logico',
        'cantidad_comparacion',
        'nombre_certificado'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'parametro_embarcacion' => 'string',
        'operador_logico' => 'string',
        'cantidad_comparacion' => 'string',
        'nombre_certificado' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'parametro_embarcacion' => 'required',
        'operador_logico' => 'required',
        'cantidad_comparacion' => 'required',
        'nombre_certificado' => 'required'
    ];


}
