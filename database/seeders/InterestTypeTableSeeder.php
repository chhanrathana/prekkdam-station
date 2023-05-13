<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InterestRate;

class InterestTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rates = getBackupData($name = 'interest_rates');        
        $this->storeInterestRate($rates);
    }

    private function storeInterestRate($rates){
        $data = [];
        foreach ($rates as $item) {        
               $data[] = [
                'id' => $item['id'],                
                'code' => $item['code'],
                'name' => $item['name'],
                'rate' => $item['rate'],
                'commission_rate' => $item['commission_rate'],
                'interval' => $item['interval'],
                'sort' => $item['sort'],
                'css' => $item['css'],                
                'setting' => $item['setting'],                
                
                'created_at' => $item['created_at'],
                'updated_at' => $item['updated_at'],
                'deleted_at' => $item['deleted_at'],
            ];          
        }
        $chunks = array_chunk($data, 1000);
        foreach ($chunks as $chunk) {
            InterestRate::insert($chunk);
        }
    }
}