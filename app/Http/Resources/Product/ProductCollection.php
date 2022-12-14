<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'details' => $this->details,
            'price' => $this->price,
            'discount' => $this->discount,
            'total_Price' => $this->discount == 0 ? $this->price : round((1 - ($this->discount/100)) * $this->discount, 2),
        ];
    }
}
