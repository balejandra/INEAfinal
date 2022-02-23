<?php

namespace App\Models\Zarpes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class EquipoPermisoZarpe
 * @package App\Models
 * @version February 20, 2022, 3:06 am UTC
 *
 * @property unsignedBigInteger $permiso_zarpe_id
 * @property unsignedBigInteger $equipo_id
 */
class EquipoPermisoZarpe extends Model implements Auditable
{
    use SoftDeletes;
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $connection = 'pgsql_zarpes_schema';
    public $table = 'equipo_permiso_zarpes';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'permiso_zarpe_id',
        'equipo_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'permiso_zarpe_id' => 'required',
        'equipo_id' => 'required'
    ];


}