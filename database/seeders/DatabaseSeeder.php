<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            GeolocationTableSeeder::class,
            SetupTableSeeder::class,
            UsersTableSeeder::class,
            MenuTableSeeder::class,
            BranchTableSeeder::class,
            // RoleSeeder::class,
            ProductTableSeeder::class,
            ShareholderTableSeeder::class,
            VehicleTableSeeder::class,           
            PaymentTableSeeder::class,
            SaleTypeTableSeeder::class,
            StationSaleTableSeeder::class,
        ]);
    }
}
