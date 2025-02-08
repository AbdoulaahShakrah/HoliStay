<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AmenityCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($amenity) {
            return[
                'amenity_id' => $amenity->amenity_id,
                'name' => $amenity->name
            ];
        })->toArray();
    }
}
