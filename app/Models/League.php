<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class League extends BaseModel
{
    const PREMIER_LEAGUE_ID = 39;
    const LA_LIGA_ID = 140;
    const SERIE_A = 135;
    const LEAGUE_1_ID = 61;
    const BUNDESLIGA_ID = 78;
    const CHAMPIONS_LEAGUE_ID = 2;
    const EUROPA_LEAGUE_ID = 3;
    const V_LEAGUE_ID = 340;

    const TYPE_CUP = 'Cup';
    const TYPE_LEAGUE = 'League';

    protected $fillable = [
        'id',
        'name',
        'name_vi',
        'slug',
        'type',
        'logo',
        'local_logo',
        'country_id',
        'order',

        // extended fields
        'sync_count',
    ];

    public function scopeCurrent(Builder $query): void
    {
        $query->where('current', true);
    }

    public function seasons(): HasMany
    {
        return $this->hasMany(Season::class)->orderBy('year', 'desc');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function currentSeason(): HasOne
    {
        return $this->hasOne(Season::class)->where('seasons.current', true);
    }

    public function currentRound(): HasOne
    {
        return $this->hasOne(Round::class)->where('rounds.current', true);
    }
}
