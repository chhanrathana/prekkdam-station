<?php
namespace Database\Seeders;

use App\Models\SaleMgts\StationSaleStatus;
use Illuminate\Database\Seeder;
use App\Models\MasterData\SaleType;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StationSaleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = json_decode(file_get_contents(base_path('database/seeders/Data/station_sale_status.json')), true);
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
            StationSaleStatus::insert( $chunk );
        }

        // $data = json_decode(file_get_contents(base_path('database/seeders/Data/station_sales.json')), true);
        // $inserts = [];
        // foreach ( $data['RECORDS'] as $item ){            
        //     $inserts [] 
        //     = [
        //         'id' => $item['id'],
        //         'name_kh' => $item['name_kh'],
        //         'name_en' => $item['name_en'],
        //         'color' => $item['color'],                
        //         'active' => $item['active'],
        //         'sort' => (int)($item['sort']),
        //         'created_at'=> Carbon::now(),
        //         'updated_at'=> Carbon::now()
        //     ];
        // }        
        // $chunks = array_chunk( $inserts , 5000 );
        // foreach ( $chunks as $chunk ){
        //     StationSaleStatus::insert( $chunk );
        // }

        // $data = json_decode(file_get_contents(base_path('database/seeders/Data/station_sale_products.json')), true);
        // $inserts = [];
        // foreach ( $data['RECORDS'] as $item ){            
        //     $inserts [] 
        //     = [
        //         'sale_type_id' => $item['sale_type_id'],
        //         'product_id' => $item['product_id'],                
        //     ];
        // }        
        // $chunks = array_chunk( $inserts , 5000 );
        // foreach ( $chunks as $chunk ){
        //     DB::table('sale_type_products')->insert( $chunk );
        // }
    }
}