<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Fixture extends BaseModel
{
    const STATUS_NOT_STARTED = 'Not Started';
    const STATUS_TIME_TO_BE_DEFINED = 'Time to be defined';
    const STATUS_MATCH_FINISHED = 'Match Finished';
    const STATUS_MATCH_POSTPONED = 'Match Postponed';
    const STATUS_MATCH_CANCELLED = 'Match Cancelled';
    const STATUS_TECHNICAL_LOSS = 'Technical loss';
    const STATUS_WALKOVER = 'Walkover';
    const STATUS_MATCH_ABANDONED = 'Match Abandoned';
    const STATUS_FIRST_HALF = 'First Half';

    const HOURS_COMING = 5; // to calculate if a match is a coming match
    const HOURS_JUST = 5; // to calculate if a match is a just match

    const FIXTURE_LIMIT = 30;


    protected $fillable = [
        'id',
        'referee',
        'date',
        'league_id',
        'season',
        'round_id',
        'round',
        'timestamp',
        'periods',
        'status',
        'venue_id',
        'teams',
        'goals',
        'score',
        'home_team_id',
        'away_team_id',
        'is_live',
        'has_live_report',

        // extended fields
        'sync_count',
    ];

    protected $casts = [
        'teams' => 'array',
        'goals' => 'array',
        'score' => 'array',
        'status' => 'array',
        'periods' => 'array',
    ];

    public function statistics(): HasMany
    {
        return $this->hasMany(FixtureStatistics::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(FixtureEvent::class);
    }

    public function lineups(): HasMany
    {
        return $this->hasMany(FixtureLineup::class);
    }

    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class);
    }

    public static function isFinished(string $status): bool
    {
        return in_array($status, [
            self::STATUS_MATCH_FINISHED,
            self::STATUS_MATCH_POSTPONED,
            self::STATUS_MATCH_CANCELLED,
            self::STATUS_TECHNICAL_LOSS,
            self::STATUS_WALKOVER,
            self::STATUS_MATCH_ABANDONED,
        ]);
    }

    public static function setLiveReport(array $fixtureIds): bool
    {
        return self::whereIn('id', $fixtureIds)
            ->where('has_live_report', false)
            ->update(['has_live_report' => true]);
    }

    public static function getByLeagueAndSeason(int $leagueId, int $season, bool $isSchedule): Collection
    {
        $query = self::where('league_id', $leagueId)
            ->where('season', $season);

        if ($isSchedule) {
            $today = Carbon::now()->subHours(self::HOURS_JUST)->timestamp;
            $query->where('timestamp', '>=', $today)
                ->orderBy('date', 'asc');
        } else {
            $today = Carbon::now()->addHours(self::HOURS_COMING)->timestamp;
            $query->where('timestamp', '<=', $today)
                ->orderBy('date', 'desc');
        }

        return $query->limit(self::FIXTURE_LIMIT)->get();
    }

    public static function getByLeagueAndRound(int $leagueId, int $roundId, bool $isSchedule): Collection
    {
        $query = self::where('league_id', $leagueId)
            ->where('round_id', $roundId);

        if ($isSchedule) {
            $query->orderBy('date', 'asc');
        } else {
            $query->orderBy('date', 'desc');
        }

        return $query->get();
    }

    public static function getCurrentRound(int $leagueId, int $season, bool $isSchedule): ?Round
    {
        $query = self::where('league_id', $leagueId)
            ->where('season', $season);

        if ($isSchedule) {
            $query->whereJsonContains('status->long', self::STATUS_NOT_STARTED)
                ->orderBy('date', 'asc');
        } else {
            $query->whereJsonDoesntContain('status->long', self::STATUS_NOT_STARTED)
                ->whereJsonDoesntContain('status->long', self::STATUS_TIME_TO_BE_DEFINED)
                ->orderBy('date', 'desc');
        }

        $fixture = $query->first();

        if (empty($fixture)) {
            return null;
        }

        return Round::findOrFail($fixture->round_id);
    }

    public function league(): BelongsTo
    {
        return $this->belongsTo(League::class);
    }

    public static function getLatestHead2HeadFixtures(int $homeTeamId, int $awayTeamId, int $limit = 15): Collection
    {
        $timeMax = time() - 2 * 3600;

        return self::where(function ($query) use ($homeTeamId, $awayTeamId) {
                $query->where(function ($subQuery) use ($homeTeamId, $awayTeamId) {
                    $subQuery->where('home_team_id', $homeTeamId)->where('away_team_id', $awayTeamId);
                })->orWhere(function ($subQuery) use ($homeTeamId, $awayTeamId) {
                    $subQuery->where('home_team_id', $awayTeamId)->where('away_team_id', $homeTeamId);
                });
            })
            ->where('timestamp', '<', $timeMax)
            ->orderBy('timestamp', 'desc')
            ->limit($limit)
            ->get();
    }

    public static function getLatestFixtures(int $teamId, int $limit = 10): Collection
    {
        $timeMax = time() - 2 * 3600;

        return self::where(function ($query) use ($teamId) {
            $query->where('home_team_id', $teamId)
                ->orWhere('away_team_id', $teamId);
            })
            ->where('timestamp', '<', $timeMax)
            ->orderBy('timestamp', 'desc')
            ->limit($limit)
            ->get();
    }
}
