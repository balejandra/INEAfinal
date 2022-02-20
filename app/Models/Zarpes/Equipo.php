<?php

namespace App\Models\Zarpes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Equipo
 * @package App\Models
 * @version February 19, 2022, 11:54 pm UTC
 *
 * @property string $equipo
 */
class Equipo extends Model implements Auditable
{
    use SoftDeletes;
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $connection = 'pgsql_zarpes_schema';
    public $table = 'equipos';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'equipo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'equipo' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'equipo' => 'required'
    ];

    public function permisozarpes() {
        return $this->belongsToMany(PermisoZarpe::class);
    }
}
