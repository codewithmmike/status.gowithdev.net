<?php

namespace App\Models;

class Venue extends BaseModel
{
    protected $fillable = [
        'id',
        'name',
        'address',
        'city',
        'country_id',
        'capacity',
        'surface',
        'image',
        'local_image',

        // extended fields
        'sync_count',
    ];

}
