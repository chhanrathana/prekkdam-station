<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            GeolocationTableSeeder::class,
            SetupTableSeeder::class,
            UsersTableSeeder::class,
            MenuTableSeeder::class,
            BranchTableSeeder::class ,
            RoleSeeder::class,
            ProductTableSeeder::class,
            ShareholderTableSeeder::class,
            VehicleTableSeeder::class,           
            PaymentTableSeeder::class,
            SaleTypeTableSeeder::class,
            StationSaleTableSeeder::class,
        ]);
    }
}
