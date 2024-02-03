<?php

namespace App\Models;

class FixtureLineup extends BaseModel
{
    protected $fillable = [
        'id',
        'fixture_id',
        'team_id',
        'team',
        'coach_id',
        'coach',
        'formation',
        'startXI',
        'substitutes',

        // extended fields
        'sync_count',
    ];

    protected $casts = [
        'team' => 'array',
        'coach' => 'array',
        'startXI' => 'array',
        'substitutes' => 'array',
    ];

}
