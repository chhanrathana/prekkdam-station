<?php
namespace Database\Seeders;

use App\Models\SaleMgts\WholesaleStatus;
use Illuminate\Database\Seeder;
use App\Models\MasterData\Product;
use App\Models\MasterData\ProductType;
use Carbon\Carbon;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = json_decode(file_get_contents(base_path('database/seeders/Data/product_types.json')), true);
        $inserts = [];
        foreach ( $data['RECORDS'] as $item ){            
            $inserts [] 
            = [
                'id' => $item['id'],
                'code' => $item['prefix'],
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
            ProductType::insert( $chunk );
        }


        $data = json_decode(file_get_contents(base_path('database/seeders/Data/products.json')), true);
        $inserts = [];
        foreach ( $data['RECORDS'] as $item ){
            $inserts [] 
            = [
                'id' => $item['id'],
                'product_type_id' => $item['product_type_id'],
                'code' => $item['code'],
                'name_kh' => $item['name_kh'],
                'name_en' => $item['name_en'],
                // 'unit_kh' => $item['unit_kh'],
                // 'unit_en' => $item['unit_en'],
                'active' => $item['active'],
                'sort' => (int)($item['sort']),
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ];    
        }
        $chunks = array_chunk( $inserts , 5000 );
        foreach ( $chunks as $chunk ){
            Product::insert( $chunk );
        }


        $data = json_decode(file_get_contents(base_path('database/seeders/Data/wholesale_status.json')), true);
        $inserts = [];
        foreach ( $data['RECORDS'] as $item ){
            $inserts [] 
            = [
                'id' => $item['id'],
                'name_kh' => $item['name_kh'],
                'name_en' => $item['name_en'],
                'color' => $item['color'],                
                'active' => $item['active'],
                'sort' => (int)($item['sort']),
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ];
        }
        $chunks = array_chunk( $inserts , 5000 );
        foreach ( $chunks as $chunk ){
            WholesaleStatus::insert( $chunk );
        }
    }
}