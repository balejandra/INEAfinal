<?php

namespace App\Models\Publico;


use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\SoftDeletes;


class RoleOwn extends Role
{
    use SoftDeletes;
}
