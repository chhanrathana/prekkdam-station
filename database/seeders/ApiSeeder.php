<?php
namespace Database\Seeders;
use App\Models\Systems\ApiVersion;
use Illuminate\Database\Seeder;


class ApiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $versions = [
            [
                'id'      => '036d5e5e-03fc-44b1-8bb6-c72fe574c266',  
                'version'   => 'v3.0.0',
            ],
            [
                'id'      => 'c516e553-8854-4997-8f67-61449a8aaab5',  
                'version'   => 'v3.0.1',
            ],
            [
                'id'      => '9ab04e61-1c1d-41a5-80f8-7687f19ce8ee',  
                'version'   => 'v3.0.1b',
            ],
         ];
         ApiVersion::insert($versions);         
    }
}
