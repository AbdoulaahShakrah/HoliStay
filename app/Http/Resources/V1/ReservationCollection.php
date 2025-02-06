<?php

namespace App\Http\Resources\v1;

use App\Http\Resources\V1\PropertyResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ReservationCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($reservation) {
            return [
                'reservation_id' => $reservation->reservation_id,
                'client_id' => $reservation->client_id,
                'client' => new ClientResource($reservation->whenLoaded('client')),
                'check_in_date' => $reservation->check_in_date,
                'check_out_date' => $reservation->check_out_date,
                'reservation_status' => $reservation->reservation_status,
                'reservation_amount' => $reservation->reservation_amount,
                'property' => new PropertyResource($reservation->whenLoaded('property')),
            ];
        })->toArray();
    }
}
