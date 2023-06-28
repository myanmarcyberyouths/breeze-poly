<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'content' => $request->content,
            'image' => $this->getFirstMediaUrl('post-images'),
        ];
    }
}
