<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PropertyTaxesCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($property_taxes) {
            return [
                'tax_value' => $property_taxes->tax->tax_value,
                'tax_name' => $property_taxes->tax->tax_name,
            ];
        })->toArray();
    }
}
