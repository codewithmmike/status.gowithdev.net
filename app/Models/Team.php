<?php

namespace App\Models;

class Team extends BaseModel
{
    protected $fillable = [
        'id',
        'name',
        'code',
        'country_id',
        'venue_id',
        'founded',
        'national',
        'logo',
        'local_logo',
        
        // extended fields
        'sync_count',
    ];

}
