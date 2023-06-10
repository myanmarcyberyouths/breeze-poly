<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'image' => $this->image,
            'date' => $this->date,
            'time' => $this->time,
            'place' => $this->place,
            'price' => $this->price,
            'about' => $this->about,
            'visibility' => $this->visibility,
        ];
    }

}
