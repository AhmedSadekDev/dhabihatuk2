<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResources extends JsonResource
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
            'random_code' => $this->random_code,
            'delivary' => $this->delivary,
            'addition' => $this->addition,
            'discount' => $this->discount,
            'total' => $this->total,
            'address' => $this->address,
            'lat' => $this->lat,
            'long' => $this->long,
            'date' => $this->date,
            'time' => $this->time,
            'time_id' => $this->time_id,
            'notes' => $this->notes ?? "",
            'products' => OrderDetialsResources::collection($this->details),
            'status' => $this->status,
            'created_at' => $this->created_at,
        ];
    }
}
