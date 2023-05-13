<?php
namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Seeder;


class ClientSeeder extends Seeder
{
       
    public function run()
    {       
        $clients = getBackupData($name = 'clients');        
        $this->storeClient($clients);
    }
    
   
    private function storeClient($clients){
        $data = [];
        foreach ($clients as  $item) {
            
               $data[] = [
                'id' => $item['id'],
                'code' => $item['code'],
                'name_kh' => $item['name_kh'],
                'name_en' => $item['name_en'],
                'sex' => $item['sex'],
                'date_of_birth' => $item['date_of_birth'],
                'phone_number' => $item['phone_number'],
                'status' => $item['status'],
                'user_id' => $item['user_id'],
                'village_id' => $item['village_id'],
                'branch_id' => $item['branch_id'],
                
                'created_at' => $item['created_at'],
                'updated_at' => $item['updated_at'],
                'deleted_at' => $item['deleted_at'],
            ];          
        }
        $chunks = array_chunk($data, 1000);
        foreach ($chunks as $chunk) {
          Client::insert($chunk);
        }
    }

}
