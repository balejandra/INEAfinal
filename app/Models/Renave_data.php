<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Renave_data
 * @package App\Models
 * @version February 13, 2022, 3:31 pm UTC
 *
 * @property string $numero_expediente
 * @property string $nombrebuque_actual
 * @property string $nombrebuque_anterior
 * @property string $matricula_actual
 * @property string $matricula_anterior
 * @property string $indicativo_llamada
 * @property string $destinacion
 * @property string $subclasificacion_pesquero
 * @property string $eslora
 * @property string $manga
 * @property string $puntal
 * @property string $UAB
 * @property string $UAN
 * @property string $estatus_buque
 * @property string $bandera
 * @property string $bandera_origen
 */
class Renave_data extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'renave_data';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'numero_expediente',
        'nombrebuque_actual',
        'nombrebuque_anterior',
        'matricula_actual',
        'matricula_anterior',
        'indicativo_llamada',
        'destinacion',
        'subclasificacion_pesquero',
        'eslora',
        'manga',
        'puntal',
        'UAB',
        'UAN',
        'estatus_buque',
        'bandera',
        'bandera_origen'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'numero_expediente' => 'integer',
        'nombrebuque_actual' => 'string',
        'nombrebuque_anterior' => 'string',
        'matricula_actual' => 'string',
        'matricula_anterior' => 'string',
        'indicativo_llamada' => 'string',
        'destinacion' => 'string',
        'subclasificacion_pesquero' => 'string',
        'eslora' => 'string',
        'manga' => 'string',
        'puntal' => 'string',
        'UAB' => 'string',
        'UAN' => 'string',
        'estatus_buque' => 'string',
        'bandera' => 'string',
        'bandera_origen' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'numero_expediente' => 'required',
        'nombrebuque_actual' => 'required',
        'matricula_actual' => 'required',
        'destinacion' => 'required',
        'eslora' => 'required',
        'manga' => 'required',
        'puntal' => 'required',
        'UAB' => 'required',
        'UAN' => 'required',
        'estatus_buque' => 'required',
        'bandera' => 'required',
        'bandera_origen' => 'required'
    ];


}
