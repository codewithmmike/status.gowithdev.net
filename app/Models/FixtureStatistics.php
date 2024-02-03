<?php

namespace App\Models;

class FixtureStatistics extends BaseModel
{
    protected $fillable = [
        'id',
        'fixture_id',
        'team_id',
        'shots_on_goal',
        'shots_off_goal',
        'total_shots',
        'blocked_shots',
        'shots_insidebox',
        'shots_outsidebox',
        'fouls',
        'corner_kicks',
        'offsides',
        'ball_possession',
        'yellow_cards',
        'red_cards',
        'goalkeeper_saves',
        'total_passes',
        'passes_accurate',
        'passes_%',
        
        // extended fields
        'sync_count',
    ];

}
