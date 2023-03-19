<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterData\Sex;
use App\Models\MasterData\Turn;
use App\Models\MasterData\Unit;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SetupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_decode(file_get_contents(base_path('database/seeders/Data/setup.json')), true);        
        $inserts = [];
        foreach ($data['sex'] as $item) {
            $inserts[] = [
                'id' => isset($item['id']) ? $item['id'] : null,
                'name_kh' => isset($item['name']) ? $item['name'] : null,
                'short_kh' => isset($item['short']) ? $item['short'] : null,                
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        $chunks = array_chunk($inserts, 5000);
        foreach ($chunks as $chunk) {
            Sex::insert($chunk);
        }

        $data = json_decode(file_get_contents(base_path('database/seeders/Data/turns.json')), true);        
        $inserts = [];
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
            Turn::insert($chunk);
        }

        $users[] =[
            'id'                => Str::uuid()->toString(),
            'code'              => 'L',
            'name_kh'           => 'លីត្រ',
            'name_en'           => 'Liter',            
        ];

        $chunks = array_chunk($users, 5000);
        foreach ($chunks as $chunk) {
            Unit::insert($chunk);
        }                
    }
}