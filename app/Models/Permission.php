<?php

namespace App\Models;

use App\Models\Role;

class Permission extends BaseModel
{
    protected $fillable = [
        'name',
        'guard_name',
    ];
}




