<?php

namespace App\Models\Publico;

use App\Models\Publico\Capitania;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class CapitaniaUser
 * @package App\Models
 * @version February 19, 2022, 9:36 pm UTC
 *
 * @property string $cargo
 * @property string $user_id
 * @property string $capitania_id
 */
class CapitaniaUser extends Model implements Auditable
{
    use SoftDeletes;
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    public $table = 'capitania_user';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'cargo',
        'user_id',
        'capitania_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'cargo' => 'string',
        'user_id' => 'string',
        'capitania_id' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'cargo' => 'required',
        'user_id' => 'required',
        'capitania_id' => 'required'
    ];

    public function capitanias()
    {
        return $this->hasMany(Capitania::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
