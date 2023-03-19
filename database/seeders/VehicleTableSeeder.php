<?php
namespace Database\Seeders;

use App\Models\MasterData\Branch;
use Illuminate\Database\Seeder;
use App\Models\MasterData\Product;
use App\Models\MasterData\ProductType;
use App\Models\MasterData\Vehicle;
use Carbon\Carbon;

class VehicleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = json_decode(file_get_contents(base_path('database/seeders/Data/vehicles.json')), true);
        $inserts = [];
        foreach ( $data['RECORDS'] as $item ){            
            $inserts [] 
            = [
                'id' => $item['id'],
                'plate_number' => $item['plate_number'],
                'volume_kg' => $item['volume_kg'],
                'active' => $item['active'],
                'sort' => (int)($item['sort']),
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ];
        }
        $chunks = array_chunk( $inserts , 5000 );
        foreach ( $chunks as $chunk ){
            Vehicle::insert( $chunk );
        }
    }
}