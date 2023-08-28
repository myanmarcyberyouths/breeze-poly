<?php

namespace App\Http\Resources\V1;

use App\Http\Resources\RepostEventResource;
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
            'title' => $this->title,
            'date' => $this->date,
            'time' => $this->time,
            'place' => $this->place,
            'ticket_price' => $this->ticket_price,
            'information' => $this->information,
            'visibility' => $this->visibility,
            'is_shareable' => $this->is_shareable,
            'image' => $this->getFirstMediaUrl('event-images'),
            'user' => new UserResource($this->whenLoaded('user')),
            'repost' => new RepostEventResource($this->whenLoaded('repost')),
        ];
    }

}
