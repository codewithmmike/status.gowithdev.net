<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Str;

class LeagueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $name = $this->name_vi ?? $this->name;
        $slug = $slug = Str::slug($name, '-');

        return [
            'id' => $this->id,
            'name' => $name,
            'slug' => $this->slug ?? $slug,
            'type' => $this->type,
            'logo' => $this->local_logo ? Storage::disk('public')->url($this->local_logo) : $this->logo,
            'seasons' => SeasonResource::collection($this->whenLoaded('seasons')),
            'country' => new CountryResource($this->whenLoaded('country')),
            'current_season' => new SeasonResource($this->whenLoaded('currentSeason')),
        ];
    }
}
