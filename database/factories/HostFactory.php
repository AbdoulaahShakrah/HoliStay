<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Host;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Host>
 */
class HostFactory extends Factory
{

    protected $model = Host::class;

    /** 
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => Client::all()->random()->user_id, // Substitui User::factory()
            'host_description' => $this->faker->paragraph(),
            'job' => $this->faker->jobTitle(),
            'iban' => $this->faker->iban(),
            'nif' => $this->faker->numerify('########'),
            'rate' => $this->faker->numberBetween(1, 5),
            'verification_status' => $this->faker->boolean(),
        ];
    }
}
