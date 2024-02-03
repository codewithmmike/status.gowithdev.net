<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use App\Models\Fixture;
use Illuminate\Support\Facades\Storage;

class FixtureResource extends JsonResource
{
    private static int $isComingTimestamp;
    private static int $isJustTimestamp;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $teams = $this->teams;
        if ($teams['home'] && $teams['home']['logo']) {
            $teams['home']['logo'] = Storage::disk('public')->url('images/teams/' . basename($teams['home']['logo']));
            $homeTeamId = $teams['home']['id'];
        }
        if ($teams['away'] && $teams['away']['logo']) {
            $teams['away']['logo'] = Storage::disk('public')->url('images/teams/' . basename($teams['away']['logo']));
            $awayTeamId = $teams['away']['id'];
        }

        if ($homeTeamId && $awayTeamId) {
            if ($this->relationLoaded('events')) {
                $events = $this->events->sortBy('time_elapsed');
                $homeEvents = [];
                $awayEvents = [];
                foreach ($events as $event) {
                    if ($homeTeamId == $event->team_id) {
                        $homeEvents[] = new FixtureEventResource($event);
                    } else {
                        $awayEvents[] = new FixtureEventResource($event);
                    }
                }
                $transformedEvents = [
                    'home' => $homeEvents,
                    'away' => $awayEvents,
                ];
            }

            if ($this->relationLoaded('lineups')) {
                $homeLineup = $awayLineup = null;
                foreach ($this->lineups as $lineup) {
                    if ($homeTeamId == $lineup->team_id) {
                        $homeLineup = new FixtureLineupResource($lineup);
                    } else {
                        $awayLineup = new FixtureLineupResource($lineup);
                    }
                }
                $transformedLineups = [
                    'home' => $homeLineup,
                    'away' => $awayLineup,
                ];
            }

            if ($this->relationLoaded('statistics')) {
                $homeStatistics = $awayStatistics = null;
                foreach ($this->statistics as $stat) {
                    if ($homeTeamId == $stat->team_id) {
                        $homeStatistics = new FixtureStatisticsResource($stat);
                    } else {
                        $awayStatistics = new FixtureStatisticsResource($stat);
                    }
                }
                $transformedStatistics = [
                    'home' => $homeStatistics,
                    'away' => $awayStatistics,
                ];
            }
        }

        $responseData = [
            'id' => $this->id,
            'league' => new LeagueResource($this->whenLoaded('league')),
            'venue' => new VenueResource($this->whenLoaded('venue')),
            'referee' => $this->referee,
            'date' => $this->date,
            'timestamp' => $this->timestamp,
            'season' => $this->season,
            'round' => formatRound($this->round, $this->league_id),
            'periods' => $this->periods,
            'status' => $this->status,
            'teams' => $teams,
            'goals' => $this->goals,
            'score' => $this->score,
            'has_live_report' => $this->has_live_report,
            'is_live' => $this->is_live,
            'is_coming' => !$this->is_live && $this->isComing($this->timestamp),
            'is_hot' => $this->isHot($this->league_id, $this->teams),
            'is_just' => !$this->is_live && $this->isJust($this->timestamp),
        ];

        isset($transformedLineups) && $responseData['lineups'] = $transformedLineups;
        isset($transformedEvents) && $responseData['events'] = $transformedEvents;
        isset($transformedStatistics) && $responseData['statistics'] = $transformedStatistics;

        return $responseData;
    }

    private function isComing(int $timestamp): bool
    {
        if (empty(self::$isComingTimestamp)) {
            self::$isComingTimestamp = Carbon::now()->addHours(Fixture::HOURS_COMING)->timestamp;
        }

        if ($timestamp <= self::$isComingTimestamp && $timestamp >= Carbon::now()->timestamp) {
            return true;
        }

        return false;
    }

    private function isJust(int $timestamp): bool
    {
        if (empty(self::$isJustTimestamp)) {
            self::$isJustTimestamp = Carbon::now()->subHours(Fixture::HOURS_JUST)->timestamp;
        }
        if ($timestamp >= self::$isJustTimestamp && $timestamp <= Carbon::now()->timestamp) {
            return true;
        }

        return false;
    }

    private function isHot(int $leagueId, array $teams): bool
    {
        return false;
    }
}
