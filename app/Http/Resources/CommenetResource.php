<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommenetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'commenet' => $this->commenet,
            'rate' => $this->rate,
            'user' => $this->user->name,
            'userImage' => $this->user->image,
            'created_at' => $this->created_at,
        ];
    }
}
