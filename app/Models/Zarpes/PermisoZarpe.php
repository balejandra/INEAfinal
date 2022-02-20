<?php

namespace App\Models\Zarpes;

use App\Models\Pasajero;
use App\Models\Publico\Capitania;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class PermisoZarpe
 * @package App\Models
 * @version February 20, 2022, 12:22 am UTC
 *
 * @property string $nro_solicitud
 * @property unsignedBigInteger $user_id
 * @property string $bandera
 * @property string $matricula
 * @property unsignedBigInteger $tipo_zarpe_id
 * @property unsignedBigInteger $establecimiento_nautico_id
 * @property string $coordenadas
 * @property unsignedBigInteger $destino_capitania_id
 * @property string $fecha_hora_salida
 * @property string $fecha_hora_regreso
 * @property unsignedBigInteger $status_id
 */
class PermisoZarpe extends Model implements Auditable
{
    use SoftDeletes;
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $connection = 'pgsql_zarpes_schema';
    public $table = 'permiso_zarpes';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nro_solicitud',
        'user_id',
        'bandera',
        'matricula',
        'tipo_zarpe_id',
        'establecimiento_nautico_id',
        'coordenadas',
        'destino_capitania_id',
        'fecha_hora_salida',
        'fecha_hora_regreso',
        'status_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nro_solicitud' => 'string',
        'bandera' => 'string',
        'matricula' => 'string',
        'coordenadas' => 'string',
        'fecha_hora_salida' => 'datetime',
        'fecha_hora_regreso' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nro_solicitud' => 'required',
        'user_id' => 'required',
        'bandera' => 'required',
        'matricula' => 'required',
        'tipo_zarpe_id' => 'required',
        'establecimiento_nautico_id' => 'required',
        'coordenadas' => 'required',
        'destino_capitania_id' => 'required',
        'fecha_hora_salida' => 'required',
        'fecha_hora_regreso' => 'required',
        'status_id' => 'required',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tipozarpe()
    {
        return $this->belongsTo(TipoZarpe::class);
    }

    public function establecimientonautico()
    {
        return $this->belongsTo(EstablecimientoNautico::class);
    }

    public function capitania()
    {
        return $this->belongsTo(Capitania::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function tripulantes(){
        return $this->hasMany(Tripulante::class);
    }

    public function pasajeros(){
        return $this->hasMany(Pasajero::class);
    }

    public function equipos() {
        return $this->belongsToMany(Equipo::class);
    }

    public function zarperevisions(){
        return $this->hasMany(ZarpeRevision::class);
    }
}
