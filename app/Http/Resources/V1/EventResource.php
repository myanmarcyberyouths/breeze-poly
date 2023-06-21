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
            'id' => $this->id,
            'date' => $this->date,
            'time' => $this->time,
            'place' => $this->place,
            'ticket_price' => $this->ticket_price,
            'information' => $this->information,
            'visibility' => $this->visibility,
            'is_shareable' => $this->is_shareable,
            'image' => $this->getFirstMediaUrl('event-images'),
        ];
    }

}
