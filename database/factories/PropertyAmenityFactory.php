<?php

namespace Database\Factories;

use App\Models\Amenity;
use App\Models\Property;
use App\Models\PropertyAmenity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PropertyAmenity>
 */
class PropertyAmenityFactory extends Factory
{

    protected $model = PropertyAmenity::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'property_id' => Property::all()->random()->property_id, //Property::inRandomOrder()->property_id
            'amenity_id' => Amenity::all()->random()->amenity_id,
        ];
    }
}
