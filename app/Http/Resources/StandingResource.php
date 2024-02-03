<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StandingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'rank' => $this->rank,
            'points' => $this->points,
            'goalsDiff' => $this->goalsDiff,
            'form' => $this->form,
            'status' => $this->status,
            'description' => $this->description,
            'all' => $this->all,
            'home' => $this->home,
            'away' => $this->away,
            'season' => $this->season,
            'team' => $this->team,
        ];
    }
}
