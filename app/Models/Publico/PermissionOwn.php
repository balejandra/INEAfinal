<?php

namespace App\Models\Publico;


use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\SoftDeletes;


class PermissionOwn extends Permission
{
    use SoftDeletes;
}
