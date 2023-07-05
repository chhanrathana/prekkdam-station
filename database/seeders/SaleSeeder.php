<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OilSale;
use Carbon\Carbon;

class SaleSeeder extends Seeder
{
  
    public function run()
    {
       $this->storeOilSale();
    }

    private function storeOilSale(){
        $file = json_decode(file_get_contents(base_path('database/seeders/Data/oil_sales.json')) , true );
        $data = [];
        foreach ( $file['RECORDS'] as $item ){
            $data []        = [
                'id' => $item['id'],
                'code'=> $item['code'],
                'date'=> $item['date'],

                'old_motor_right' => $item['old_motor_right'],
                'new_motor_right' => $item['new_motor_right'],
                'old_motor_left' => $item['old_motor_left'],
                'new_motor_left' => $item['new_motor_left'],
                'unit' => $item['unit'],
                'cost' => $item['cost'],
                'price' => $item['price'],
                'paid_amount' => $item['paid_amount'],
                'currency' => $item['currency'],
                'exchange_rate' => $item['exchange_rate'],
                'active' => $item['active'],
                'oil_purchase_id' => $item['oil_purchase_id'],
                'work_shift_id' => $item['work_shift_id'],
                'staff_id' => $item['staff_id'],
                'client_id' => $item['client_id'],
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ];          
        }            
        $chunks = array_chunk( $data , 5000 );
        foreach ( $chunks as $chunk ){
            OilSale::insert( $chunk );
        }
    }

    
}