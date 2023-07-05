<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OilPurchase;
use Carbon\Carbon;

class PurcahseSeeder extends Seeder
{
  
    public function run()
    {
       $this->storeOilPurchase();
    }

    private function storeOilPurchase(){
        $file = json_decode(file_get_contents(base_path('database/seeders/Data/oil_purchases.json')) , true );
        $data = [];
        foreach ( $file['RECORDS'] as $item ){
            $data []        = [
                'id' => $item['id'],
                'code'=> $item['code'],
                'date'=> $item['date'],
                'qty' => $item['qty'],
                'cost' => $item['cost'],
                'currency' => $item['currency'],

                'exchange_rate' => $item['exchange_rate'],
                'paid_amount' => $item['paid_amount'],
                'oil_type_id' => $item['oil_type_id'],
                'status_id' => $item['status_id'],
                'vendor_id' => $item['vendor_id'],
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ];          
        }     
        $chunks = array_chunk( $data , 5000 );
        foreach ( $chunks as $chunk ){
            OilPurchase::insert( $chunk );
        }
    }

    
}