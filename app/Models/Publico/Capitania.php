<?php

namespace App\Models\Publico;

use App\Models\User;
use App\Models\Zarpes\EstablecimientoNautico;
use App\Models\Zarpes\PermisoZarpe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Capitania
 * @package App\Models
 * @version January 19, 2022, 11:00 pm UTC
 *
 * @property string $nombre
 * @property string $sigla
 */
class Capitania extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $connection = 'pgsql_public_schema';
    public $table = 'capitanias';


    protected $dates = ['deleted_at'];

    public $fillable = [
        'nombre',
        'sigla'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'sigla' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required',
        'sigla' => 'required'
    ];
/*
    public function coordenas_capitania()
    {
        return $this->HasMany(Coordenas_capitania::class);
    }*/
    public static function boot() {
        parent::boot();
        static::deleting(function($capi) {
             $capi->CoordenadasCapitania()->delete();
        });
    }

    public function CoordenadasCapitania()
    {
        return $this->hasMany(CoordenadasCapitania::class);
    }


    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function establecimientonauticos()
    {
        return $this->hasMany(EstablecimientoNautico::class);
    }



}
