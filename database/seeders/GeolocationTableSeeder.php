<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterData\Province;
use App\Models\MasterData\District;
use App\Models\MasterData\Commune;
use App\Models\MasterData\Village;
use Carbon\Carbon;

class GeolocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = json_decode( file_get_contents(base_path('database/seeders/Data/province.json')) , true );
        $inserts = [];
        foreach ( $data['data'] as $item ){
            if($item['name_kh'] != ''){
                $inserts []        = [
                    'id' => $item['id'],
                    'name_kh' => $item['name_kh'],
                    'name_en' => $item['name_en'],
                    'created_at'=> Carbon::now(),
                    'updated_at'=> Carbon::now()
                ];    
            }            
        }
        $chunks = array_chunk( $inserts , 5000 );
        foreach ( $chunks as $chunk ){
            Province::insert( $chunk );
        }

        $data = json_decode( file_get_contents(base_path('database/seeders/Data/district.json')) , true );
        $inserts = [];
        foreach ( $data['data'] as $item ){
            if($item['name_kh'] != ''){
                $inserts []        = [
                    'id' => $item['id'],
                    'province_id' => $item['province_id'],
                    'name_kh' => $item['name_kh'],
                    'name_en' => $item['name_en'],
                    'created_at'=> Carbon::now(),
                    'updated_at'=> Carbon::now()
                ];    
            }            
        }
        $chunks = array_chunk( $inserts , 5000 );
        foreach ( $chunks as $chunk ){
            District::insert( $chunk );
        }


        $data = json_decode( file_get_contents(base_path('database/seeders/Data/commune.json')) , true );
        $inserts = [];
        foreach ( $data['data'] as $item ){
            if($item['name_kh'] != ''){
                $inserts []        = [
                    'id' => $item['id'],
                    'province_id' => $item['province_id'],
                    'district_id' => $item['district_id'],
                    'name_kh' => $item['name_kh'],
                    'name_en' => $item['name_en'],
                    'created_at'=> Carbon::now(),
                    'updated_at'=> Carbon::now()
                ];    
            }            
        }
        $chunks = array_chunk( $inserts , 5000 );
        foreach ( $chunks as $chunk ){
            Commune::insert( $chunk );
        }
        
        $data = json_decode( file_get_contents(base_path('database/seeders/Data/village.json')) , true );
        $inserts = [];
        foreach ( $data['data'] as $item ){
            if($item['name_kh'] != ''){
                $inserts []        = [
                    'id' => $item['id'],
                    'province_id' => $item['province_id'],
                    'district_id' => $item['district_id'],
                    'commune_id' => $item['commune_id'],
                    'name_kh' => $item['name_kh'],
                    'name_en' => $item['name_en'],
                    'created_at'=> Carbon::now(),
                    'updated_at'=> Carbon::now()
                ];    
            }            
        }
        $chunks = array_chunk( $inserts , 5000 );
        foreach ( $chunks as $chunk ){
            Village::insert( $chunk );
        }
    }
}