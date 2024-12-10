<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 100), // Substitui User::factory()
            'client_name' => $this->faker->name(),
            'phone_number' => $this->faker->phoneNumber(),
            'languages' => $this->faker->randomElement(['English', 'Spanish', 'French']),
        ];
    }
}
