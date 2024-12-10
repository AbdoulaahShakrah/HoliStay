<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\PropertyTax;
use App\Models\Tax;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PropertyTax>
 */
class PropertyTaxFactory extends Factory
{

    protected $model = PropertyTax::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'property_id' => Property::all()->random()->property_id,  // Escolhe uma propriedade aleatória
            'tax_id' => Tax::all()->random()->tax_id,
        ];
    }
}
