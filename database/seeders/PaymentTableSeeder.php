<?php
namespace Database\Seeders;

use App\Models\Payments\Payment;
use App\Models\Payments\PaymentMethod;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PaymentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = json_decode(file_get_contents(base_path('database/seeders/Data/payment_methods.json')), true);
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
            PaymentMethod::insert( $chunk );
        }

        $data = json_decode(file_get_contents(base_path('database/seeders/Data/payments.json')), true);
        $inserts = [];
        foreach ( $data['RECORDS'] as $item ){            
            $inserts [] 
            = [
                'id' => $item['id'],
                'reference_number' => $item['reference_number'],
                'paid_amount' => $item['paid_amount'],
                'payment_method_id' => $item['payment_method_id'] != ''?$item['payment_method_id']:null,
                'remark' => $item['remark'],
                'payment_datetime' => Carbon::createFromFormat('d/m/Y H:i:s',$item['payment_datetime'])->format('Y-m-d') ,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ];
        }
        $chunks = array_chunk( $inserts , 5000 );
        foreach ( $chunks as $chunk ){
            Payment::insert( $chunk );
        }
    }
}