<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;

class Standing extends BaseModel
{
    protected $fillable = [
        'id',
        'rank',
        'team_id',
        'points',
        'goalsDiff',
        'group',
        'form',
        'status',
        'description',
        'all',
        'home',
        'away',
        'update',
        'league_id',
        'season',
        'team',

        // extended fields
        'sync_count',
    ];

    protected $casts = [
        'team' => 'array',
        'all' => 'array',
        'home' => 'array',
        'away' => 'array',
    ];

    public static function getBySeasonLeague(int $season, int $leagueId, int $limit = 0): Collection
    {
        $query = self::where('season', $season)
            ->where('league_id', $leagueId)
            ->orderBy('group', 'asc')
            ->orderBy('rank', 'asc');

        if ($limit) {
            $query->limit($limit);
        }

        return $query->get();
    }
}
