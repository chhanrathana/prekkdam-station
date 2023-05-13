<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;
use App\Models\District;
use App\Models\Commune;
use App\Models\Village;
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
         //province
        $file               = file_get_contents(base_path('database/seeders/Data/province.json'));
        $provinces          = json_decode( $file , true );
        $data               = [];
        foreach ( $provinces['data'] as $province ){
            if($province['name_kh'] != ''){
                $data []        = [
                    'id' => $province['id'],
                    'name_kh'=> $province['name_kh'],
                    'name_en' => $province['name_en'],
                    'active' => ($province['id'] == '21' || $province['id'] == '05')?true:false,
                    'created_at'=> Carbon::now(),
                    'updated_at'=> Carbon::now()
                ];
            }

        }

        $chunks = array_chunk( $data , 5000 );
        foreach ( $chunks as $chunk ){
            Province::insert( $chunk );
        }

        // // district
        $file               = file_get_contents(base_path('database/seeders/Data/district.json'));
        $districts          = json_decode( $file , true );
        $data               = [];
        foreach ( $districts['data'] as $district ){

            if ($district['name_kh'] != '') {
            $data []        = [

                    'name_kh'          => isset($district['name_kh']) ? $district['name_kh'] :  null,
                    'name_en' => isset($province['name_en']) ? $province['name_en'] : null,
                'id'          => isset( $district['id'] ) ? $district['id'] :  null,
                'province_id' => isset( $district['province_id'] ) ? $district['province_id'] :  null,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ];
            }
        }

        $chunks = array_chunk( $data , 5000 );
        foreach ( $chunks as $chunk ){
            District::insert( $chunk );
        }

        // commune
        $file               = file_get_contents(base_path('database/seeders/Data/commune.json'));
        $communes          = json_decode( $file , true );
        $data               = [];
        foreach ( $communes['data'] as $commune ){
            if ($commune['name_kh'] != '') {
            $data []        = [

                    'name_kh'          => isset( $commune['name_kh'] ) ? $commune['name_kh'] :  null,
                    'name_en' => isset($province['name_en']) ? $province['name_en'] : null,
                'id'          => isset( $commune['id'] ) ? $commune['id'] : null,
                'district_id' => isset( $commune['district_id'] ) ? $commune['district_id'] : null,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ];
            }
        }

        $chunks = array_chunk( $data , 5000 );
        foreach ( $chunks as $chunk ){
            Commune::insert( $chunk );
        }

        // village
        $file               = file_get_contents(base_path('database/seeders/Data/village.json'));
        $villages          = json_decode( $file , true );
        $data               = [];
        foreach ( $villages['data'] as $village ){
            if ($village['name_kh'] != '') {
            $data []        = [

                    'name_kh'          => isset( $village['name_kh'] ) ? $village['name_kh'] : null,
                    'name_en' => isset($province['name_en']) ? $province['name_en'] : null,
                'id'          => isset( $village['id'] ) ? $village['id'] : null,
                'commune_id'  => isset( $village['commune_id'] ) ? $village['commune_id'] : null,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ];
            }
        }

        $chunks = array_chunk( $data , 5000 );
        foreach ( $chunks as $chunk ){
            Village::insert( $chunk );
        }
    }
}
