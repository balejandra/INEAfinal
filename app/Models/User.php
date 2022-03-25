<?php

namespace App\Models;


use App\Models\Publico\Capitania;
use App\Models\Zarpes\PermisoZarpe;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use OwenIt\Auditing\Contracts\Auditable;


class User extends Authenticatable implements MustVerifyEmail, Auditable
{
    use HasFactory, Notifiable;
    use HasRoles;
    use \OwenIt\Auditing\Auditable;

    protected $connection = 'pgsql_public_schema';
    public $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombres',
        'apellidos',
        'tipo_identificacion',
        'numero_identificacion',
        'iniciales',
        'fecha_nacimiento',
        'telefono',
        'direccion',
        'tipo_usuario',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'email' => 'required|unique:users',
        'nombres' => 'required',
        'password' => 'required'
    ];
    public function capitanias()
    {
        return $this->belongsToMany(Capitania::class);
    }

    public function permisozarpes()
    {
        return $this->hasMany(PermisoZarpe::class);
    }
}
