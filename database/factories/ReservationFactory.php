<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Property;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{

    protected $model = Reservation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'property_id' => Property::all()->random()->property_id,
            'client_id' => Client::all()->random()->client_id,
            'check_in_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'check_out_date' => $this->faker->dateTimeBetween('+1 month', '+2 months'),
            'reservation_status' => $this->faker->randomElement(['Pending', 'Confirmed', 'Cancelled']),
            'reservation_amount' => $this->faker->randomFloat(2, 100, 1000),
        ];
    }
}
