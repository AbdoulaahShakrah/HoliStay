<?php

namespace Database\Factories;

use App\Models\Host;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    protected $model = Property::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'host_id' => Host::all()->random()->host_id,
            'property_name' => $this->faker->sentence(3),
            'property_country' => $this->faker->country(),
            'property_city' => $this->faker->city(),
            'property_address' => $this->faker->address(),
            'property_type' => $this->faker->randomElement(['Apartment', 'House', 'Studio']),
            'property_bedrooms' => $this->faker->numberBetween(1, 5),
            'property_bathrooms' => $this->faker->numberBetween(1, 3),
            'property_beds' => $this->faker->numberBetween(1, 10),
            'cancellation_policy' => $this->faker->numberBetween(1, 7),
            'property_price' => $this->faker->randomFloat(2, 50, 1000),
            'property_status' => $this->faker->randomElement(['Available', 'Occupied']),
            'property_capacity' => $this->faker->numberBetween(1, 15),
            'property_description' => $this->faker->paragraph(),
            'page_visits' => $this->faker->numberBetween(0, 1000),
        ];
    }
}
