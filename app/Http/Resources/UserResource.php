<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => ($this->name) ?? "",
            'email' => ($this->email) ?? "" ,
            'phone' => ($this->phone) ?? "",
            'image' => ($this->image) ?? "" ,
            'lat' => ($this->lat) ?? "" ,
            'long' => ($this->long) ?? "" ,
            'address' => ($this->address) ?? "" ,
            'twitter' => ($this->twitter) ?? "" ,
            'token' => ($this->token) ?? "" ,
            'created_at' => ($this->created_at) ?? "" ,
        ];
    }
}