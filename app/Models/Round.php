<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Round extends BaseModel
{
    protected $fillable = [
        'id',
        'league_id',
        'season',
        'name',
        'order',
        'current',

        // extended fields
        'sync_count',
    ];

    public function scopeCurrent(Builder $query): void
    {
        $query->where('current', true);
    }


    public static function getCurrentRound(int $leagueId, int $roundId = 0, bool $isSchedule = false): Round
    {
        if (!$roundId) {
            $round = Round::where('league_id', $leagueId)->current()->first();
            if (empty($round)) {
                $round = Fixture::getCurrentRound($leagueId, date('Y'), $isSchedule);
            }
        } else {
            $round = Round::findOrFail($roundId);
        }

        return $round;
    }

    public static function getAllRounds(int $leagueId, int $season): Collection
    {
        return self::where('league_id', $leagueId)
            ->where('season', $season)
            ->orderBy('id', 'asc')
            ->get();
    }

    public function seasonRelation(): BelongsTo
    {
        return $this->belongsTo(Season::class, 'season', 'year')->where('league_id', $this->league_id);
    }
}
