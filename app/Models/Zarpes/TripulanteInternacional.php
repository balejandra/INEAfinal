<?php

namespace App\Models\Zarpes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
 
class tripulanteInternacional extends Model implements Auditable
{
   use SoftDeletes;
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $connection = 'pgsql_zarpes_schema';
    public $table = 'tripulante_internacionals';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nombres',
        'apellidos',
        'funcion',
        'tipo_doc',
        'nro_doc',
        'rango',
        'doc',
        'permiso_zarpe_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [

        'id' => 'integer',
        'nombres'=> 'string',
        'apellidos'=> 'string',
        'funcion'=> 'string',
        'tipo_doc'=> 'string',
        'nro_doc'=> 'string',
        'rango'=> 'string',
        'doc'=> 'string',
        'permiso_zarpe_id' => 'integer'
        
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
         'nombres'=> 'required',
        'apellidos'=> 'required',
        'funcion'=> 'required',
        'tipo_doc'=> 'required',
        'nro_doc'=> 'required',
        'rango'=> 'required',
        'doc'=> 'required',
        'permiso_zarpe_id' => 'required',

    ];

    public function permisozarpe()
    {
        return $this->belongsTo(PermisoZarpe::class);
    }

  
}
