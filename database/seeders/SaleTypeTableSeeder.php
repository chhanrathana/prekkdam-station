<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterData\SaleType;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SaleTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = json_decode(file_get_contents(base_path('database/seeders/Data/sale_types.json')), true);
        $inserts = [];
        foreach ( $data['RECORDS'] as $item ){            
            $inserts [] 
            = [
                'id' => $item['id'],
                'code' => $item['code'],
                'name_kh' => $item['name_kh'],
                'name_en' => $item['name_en'],
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ];
        }        
        $chunks = array_chunk( $inserts , 5000 );
        foreach ( $chunks as $chunk ){
            SaleType::insert( $chunk );
        }

        $data = json_decode(file_get_contents(base_path('database/seeders/Data/sale_type_products.json')), true);
        $inserts = [];
        foreach ( $data['RECORDS'] as $item ){            
            $inserts [] 
            = [
                'sale_type_id' => $item['sale_type_id'],
                'product_id' => $item['product_id'],                
            ];
        }        
        $chunks = array_chunk( $inserts , 5000 );
        foreach ( $chunks as $chunk ){
            DB::table('sale_type_products')->insert( $chunk );
        }
    }
}