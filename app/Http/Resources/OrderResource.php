<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'status' => $this->status,
            'total_price' => number_format($this->total_price, 2, ',', '.'),
            
            'created_at' => $this->created_at->format('d/m/Y H:i'),
            'items' => $this->items->map(fn ($item) => [
                'product' => $item->product->name,
                'quantity' => $item->quantity,
                'unit_price' => number_format($item->unit_price, 2, ',', '.'),
                'subtotal' => number_format($item->subtotal, 2, ',', '.'),
            ]),
        ];
    }
}
