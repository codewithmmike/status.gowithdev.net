<?php

namespace App\Models;

class FixtureEvent extends BaseModel
{
    protected $fillable = [
        'id',
        'fixture_id',
        'team_id',
        'player_id',
        'assist_id',
        'time_elapsed',
        'time',
        'team',
        'player',
        'assist',
        'type',
        'detail',
        'comments',
        'unique_combined_columns',

        // extended fields
        'sync_count',
    ];

    protected $casts = [
        'team' => 'array',
        'time' => 'array',
        'player' => 'array',
        'assist' => 'array',
    ];
}
