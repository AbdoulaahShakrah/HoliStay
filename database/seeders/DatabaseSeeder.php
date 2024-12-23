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
use App\Models\UserRole;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {

        $users = User::factory(20)->create();

        foreach ($users as $user) {
            $userRole = UserRole::factory()->create([
                'user_id' => $user->id,
            ]);

            if ($userRole->role == 'client') {
                Client::factory()->create([
                    'user_id' => $user->id,
                ]);
            } else {
                Client::factory()->create([
                    'user_id' => $user->id,
                ]);
                Host::factory()->create([
                    'user_id' => $user->id,
                ]);
            }
        }

        Tax::factory(5)->create();

        Amenity::factory(10)->create();

        Property::factory(50)->create();

        Photo::factory(100)->create();


        $reservations = Reservation::factory(30)->create();
        PropertyTax::factory(70)->create();
        PropertyAmenity::factory(100)->create();

        foreach ($reservations as $reservation) {
            Payment::factory()->create([
                'reservation_id' => $reservation->reservation_id,
            ]);
        }
    }
}
