<?php

namespace App\Http\Resources;

use App\Models\Images;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResources extends JsonResource
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
            'product_id' => $this->product_id,
            'product_name' => $this->product->title(),
            'product_image' => env('APP_URL') . 'Admin/images/products/' . Images::where('product_id', $this->product->id)->first()->image,
            'count' => $this->count,
            'total' => $this->count * $this->product->price,
            'wrapping_id' => $this->wrapping_id,
            'wrapping_name' => $this->wrapping->title(),
            'chopping_id' => $this->chopping_id,
            'chopping_name' => $this->chopping->title(),
            'notes' => ($this->notes) ?? "",
            'created_at' => $this->created_at,
        ];
    }
}
