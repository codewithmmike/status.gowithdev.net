<?php

namespace App\Models;

class EmailNotification extends BaseModel
{
    protected $fillable = [
        'email',
        'status',
        'description',
    ];
}

