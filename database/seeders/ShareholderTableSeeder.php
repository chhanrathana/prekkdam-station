<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Settings\Product;
use App\Models\Settings\ProductType;
use App\Models\Settings\ShareHolder;
use App\Models\Settings\ShareHolderType;
use Carbon\Carbon;

class ShareholderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = json_decode(file_get_contents(base_path('database/seeders/Data/shareholder_types.json')), true);
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
            ShareHolderType::insert( $chunk );
        }


        $data = json_decode(file_get_contents(base_path('database/seeders/Data/shareholders.json')), true);
        $inserts = [];
        foreach ( $data['RECORDS'] as $item ){
            $inserts [] 
            = [
                'id' => $item['id'],
                'shareholder_type_id' => $item['shareholder_type_id'],
                'code' => $item['code'],
                'is_company' => $item['is_company'],
                'name_kh' => $item['name_kh'],
                'name_en' => $item['name_en'],
                'sex' => $item['sex'] != ''?$item['sex']:null,
                'phone_number_01' => $item['phone_number_01'],
                'phone_number_02' => $item['phone_number_02'],
                'home_number' => $item['home_number'],
                'street_number' => $item['street_number'],
                'address_detail' => $item['address_detail'],
                'province_id' => $item['province_id'] != ''?$item['province_id']:null,
                'district_id' => $item['district_id'] != ''?$item['district_id']:null,
                'commune_id' => $item['commune_id'] != ''?$item['commune_id']:null,
                'village_id' => $item['village_id'] != ''?$item['village_id']:null,

                'active' => $item['active'],
                'sort' => (int)($item['sort']),
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ];    
        }
        $chunks = array_chunk( $inserts , 5000 );
        foreach ( $chunks as $chunk ){
            ShareHolder::insert( $chunk );
        }
    }
}