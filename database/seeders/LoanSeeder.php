<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;
use App\Models\Loan;

class LoanSeeder extends Seeder
{
  
    public function run()
    {
       // loan
       $branches = getBackupData('loans');        
       $this->storeLoan($branches);
    }

     private function storeLoan($branches){        
        $data = [];
        foreach ($branches as $item) {                 
               $data[] = [
                'id' => $item['id'],                
                'code' => $item['code'],
                'principal_amount' => $item['principal_amount'],
                'term' => $item['term'],
                'pending_amount' => $item['pending_amount'],
                'last_pending_amount' => $item['last_pending_amount'],
                'rate' => $item['rate'],
                'commission_rate' => $item['commission_rate'],
                'registration_date' => $item['registration_date'],
                'start_end_interest_date' => $item['start_end_interest_date'],
                'last_end_interest_date' => $item['last_end_interest_date'],
                'finish_end_interest_date' => $item['finish_end_interest_date'],
                'finish_discount' => $item['finish_discount'],
                'finish_discount_amount' => $item['finish_discount_amount'],
                'admin_rate' => $item['admin_rate'],
                'admin_amount' => $item['admin_amount'],
                'status' => $item['status'],
                'client_id' => $item['client_id'],
                'staff_id' => $item['staff_id'],
                'interest_rate_id' => $item['interest_rate_id'],
                'branch_id' => $item['branch_id'],
                
                'created_at' => $item['created_at'],
                'updated_at' => $item['updated_at'],
                'deleted_at' => $item['deleted_at'],
            ];          
        }
        $chunks = array_chunk($data, 1000);
        foreach ($chunks as $chunk) {
          Loan::insert($chunk);
        }

        $clients = Client::all();
        foreach($clients as $client){
            $_client = Client::find($client->id);
            if($_client->loans->count() > 1){
                $_client->is_new = 0;
                $_client->save();
            }
        }
    }   
}