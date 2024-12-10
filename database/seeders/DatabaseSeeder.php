<?php

namespace Database\Seeders;

use App\Models\Amenity;
use App\Models\Client;
use App\Models\Host;
use App\Models\Payment;
use App\Models\Photo;
use App\Models\Property;
use App\Models\PropertyAmenity;
use App\Models\PropertyTax;
use App\Models\Reservation;
use App\Models\Tax;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {

        Client::factory(10)->create();

        Host::factory(5)->create();

        Tax::factory(5)->create();

        Amenity::factory(10)->create();

        Property::factory(20)->create();

        Photo::factory(50)->create();

        $reservations = Reservation::factory(10)->create();
        PropertyTax::factory(10)->create();
        PropertyAmenity::factory(10)->create();

        foreach ($reservations as $reservation) {
            Payment::factory()->create([
                'reservation_id' => $reservation->reservation_id,
                'payment_method' => 'Credit Card',
            ]);
        }
    }
}
