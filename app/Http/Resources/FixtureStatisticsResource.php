<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FixtureStatisticsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $columns = [
            'id',
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
        ];

        $formattedFields = [];
        foreach ($columns as $field) {
            $formattedFields[$field] = $this->{$field};
        }

        return $formattedFields;
    }
}
