<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            "order_number"=> $this->order_number,
            "type"=> $this->type,
            "customer_name"=> $this->customer_name,
            "customer_phone"=> $this->customer_phone,
            "delivery_fees"=> $this->delivery_fees,
            "table_number"=> $this->table_number,
            "waiter_name"=> $this->waiter_name,
            "total_price"=> $this->total_price,
            "created_at" => $this->created_at,
            "items" => MenuItemResource::collection($this->items)
        ];
    }
}
