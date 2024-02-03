<?php

namespace App\Models;

class Domain extends BaseModel
{
    protected $fillable = [
        'name',
        'type',
        'status',
        'description',
        'user_id'
    ];
}

