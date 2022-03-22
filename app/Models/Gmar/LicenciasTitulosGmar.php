<?php

namespace App\Models\Gmar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LicenciasTitulosGmar
 * @package App\Models
 * @version February 20, 2022, 3:52 pm UTC
 *
 * @property string $ci
 * @property string $nombre
 * @property string $apellido
 * @property string $solicitud
 * @property string $documento
 * @property string $nro_ctrl
 * @property string $fecha_solicitud
 * @property string $fecha_emision
 * @property string $fecha_vencimiento
 */
class LicenciasTitulosGmar extends Model
{

    use HasFactory;

    protected $connection = 'pgsql_gente_de_mar';
    public $table = 'licencias_titulos_gmar';


    public $fillable = [
        'ci',
        'nombre',
        'apellido',
        'solicitud',
        'documento',
        'nro_ctrl',
        'fecha_solicitud',
        'fecha_emision',
        'fecha_vencimiento'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'ci' => 'string',
        'nombre' => 'string',
        'apellido' => 'string',
        'solicitud' => 'string',
        'documento' => 'string',
        'nro_ctrl' => 'string',
        'fecha_solicitud' => 'date',
        'fecha_emision' => 'datetime',
        'fecha_vencimiento' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'ci' => 'required',
        'nombre' => 'required',
        'apellido' => 'required',
        'solicitud' => 'required',
        'documento' => 'required',
        'nro_ctrl' => 'required',
        'fecha_solicitud' => 'required',
        'fecha_emision' => 'required',
        'fecha_vencimiento' => 'required'
    ];


}
