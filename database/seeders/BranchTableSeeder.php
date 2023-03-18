<?php
namespace Database\Seeders;

use App\Models\Settings\Branch;
use Illuminate\Database\Seeder;
use App\Models\Settings\Product;
use App\Models\Settings\ProductType;
use Carbon\Carbon;

class BranchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = json_decode(file_get_contents(base_path('database/seeders/Data/branches.json')), true);
        $inserts = [];
        foreach ( $data['RECORDS'] as $item ){            
            $inserts [] 
            = [
                'id' => $item['id'],
                'name_kh' => $item['name_kh'],
                'name_en' => $item['name_en'],
                'active' => $item['active'],
                'sort' => (int)($item['sort']),
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ];
        }
        $chunks = array_chunk( $inserts , 5000 );
        foreach ( $chunks as $chunk ){
            Branch::insert( $chunk );
        }
    }
}