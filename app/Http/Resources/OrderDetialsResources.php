<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetialsResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'count' => $this->count,
            'total' => $this->total,
            'chopping_id' => $this->chopping_id,
            'chopping_name' => $this->chopping->title(),
            'wrapping_id' => $this->wrapping_id,
            'wrapping_name' => $this->wrapping->title(),
            'notes' => $this->notes ?? "",
            'product' => new ProductResource($this->product),
        ];
    }
}
