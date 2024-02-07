<?php

namespace App\Models;

use Spatie\Permission\Traits\HasPermissions;

class Role extends BaseModel
{
    use HasPermissions;
    protected $fillable = [
        'name',
        'guard_name',
    ];
}




