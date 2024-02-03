<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name_vi ?? $this->name,
            'code' => $this->code,
            'flag' => $this->local_flag ? Storage::disk('public')->url($this->local_flag) : $this->flag,
        ];
    }
}
