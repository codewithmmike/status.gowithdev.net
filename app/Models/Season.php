<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Season extends BaseModel
{
    protected $fillable = [
        'id',
        'year',
        'start',
        'end',
        'current',
        'coverage',
        'league_id',
        'league_id',

        // extended fields
        'sync_count',
    ];

    public static function getListOfLeagueSeasons(bool $onlyCurrent): array
    {
        $query = self::select('year', 'league_id')
            ->orderBy('year', 'asc')
            ->orderBy('league_id', 'asc');

        if ($onlyCurrent) {
            $query->where('current', true)
                ->where('year', '>=', date('Y') - 1);
        }

        return $query->get()->toArray();
    }

    public function scopeCurrent(Builder $query): void
    {
        $query->where('current', true);
    }

    public static function getCurrentSeason(int $leagueId, int $season = 0): self
    {
        if (!$season) {
            $season = Season::where('league_id', $leagueId)->current()->firstOrFail();
        } else {
            $season = Season::where('league_id', $leagueId)->where('year', $season)->firstOrFail();
        }

        return $season;
    }

    public function rounds(): HasMany
    {
        return $this->hasMany(Round::class, 'season', 'year')
            ->where('rounds.league_id', $this->league_id)
            ->orderBy('rounds.id', 'asc');
    }
}
