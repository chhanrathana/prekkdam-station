<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SetupTableSeeder::class,
            CalendarsTableSeeder::class,
            UsersTableSeeder::class,
            MenuSeeder::class,
            GeolocationTableSeeder::class,            
            InterestTypeTableSeeder::class,
            ClientSeeder::class,
            PurcahseSeeder::class,
            SaleSeeder::class,
            // PaymentSeeder::class
        ]);
    }
}
