<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SeasonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $startYear = date('Y', strtotime($this->start));
        $endYear = date('Y', strtotime($this->end));
        $name = $this->year;
        if ($startYear != $endYear) {
            $name = $startYear . '-' . $endYear;
        } else if ($startYear != $this->year) {
            $name = $startYear . '-' . $this->year;
        }
        $name = 'Mùa ' . $name;

        return [
            'year' => $this->year,
            'name' => $name,
            'start' => $this->start,
            'end' => $this->end,
            'rounds' => RoundResource::collection($this->whenLoaded('rounds')),
        ];
    }
}
