<?php

namespace App\Http\Resources;

use App\Models\Chopping;
use App\Models\Favourite;
use App\Models\Images;
use App\Models\Rate;
use App\Models\Wrapping;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        $Wrappings = Wrapping::where('status', 1)->get();
        $Choppings = Chopping::where('status', 1)->get();
        return [
            'id' => $this->id,
            'name' => $this->title(),
            'desc' => $this->desc(),
            'catgeory' => $this->category->title(),
            'price' => $this->price,
            'count' => $this->count,
            'created_at' => $this->created_at,
            'image' => env('APP_URL') . 'Admin/images/products/' . Images::where('product_id', $this->id)->first()->image,
            'favourite' => (Favourite::where('user_id', (request()->header('Authorization') ? request()->user()->id : null))->first()) ? true : false,
            'rate' => (Rate::where('product_id', $this->id)->avg('rate')) ?? 0,
            'commenets' => CommenetResource::collection(Rate::where('product_id', $this->id)->get()),
            'Wrapping' => WrappingResource::collection($Wrappings),
            'Chopping' => ChoppingResource::collection($Choppings),
        ];
    }
}
