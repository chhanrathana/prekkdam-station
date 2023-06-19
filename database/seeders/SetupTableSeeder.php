<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Sex;
use App\Models\StaffStatus;
use App\Models\ExchangeRate;
use App\Models\ExpenseType;
use App\Models\LoanStatus;
use App\Models\LoanType;
use App\Models\OilStatus;
use App\Models\OilType;
use App\Models\Staff;
use App\Models\PaymentStatus;
use App\Models\WorkShift;

class SetupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->storeExpenseType();
        // branch
        $branches = getBackupData('branches');
        
        $this->storeBranch($branches);        
        
        Sex::insert([
            [
                'id' => 'M',
                'name_kh' => 'ប្រុស',
                'name_en' => 'Male',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 'F',
                'name_kh' => 'ស្រី',
                'name_en' => 'Female',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        OilType::insert([
            [
                'id' => 'ex',
                'name_kh' => 'ស៊ុបពែ',
                'name_en' => 'Super',
                'liter_of_ton' => 1390,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 'ea',
                'name_kh' => 'សាំង',
                'name_en' => 'Regular',
                'liter_of_ton' => 1390,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 'do',
                'name_kh' => 'ម៉ាស៊ូត',
                'name_en' => 'Diesel',
                'liter_of_ton' => 1190,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 'lpg',
                'name_kh' => 'ហ្គាស់',
                'name_en' => 'Gas',
                'liter_of_ton' => 1850,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        WorkShift::insert([
            [
                'id' => 'day',
                'name_kh' => 'ថ្ងៃ',
                'name_en' => 'Day',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 'night',
                'name_kh' => 'យប់',
                'name_en' => 'Night',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],           
        ]);


        StaffStatus::insert([
            [
                'id' => 'active',
                'name_kh' => 'បើក',
                'name_en' => 'ACTIVE',
                'css' => 'badge badge-success',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 'inactive',
                'name_kh' => 'បិទ',
                'name_en' => 'INACTIVE',
                'css' => 'badge badge-danger',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

       

        OilStatus::insert([            
            [
                'id' => 'on_sale',
                'name_kh' => 'ដាក់លក់',
                'name_en' => 'Progress',
                'css' => 'badge badge-info',
                'active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 'postpone',
                'name_kh' => 'ផ្អាកលក់',
                'name_en' => 'Postponse',
                'css' => 'badge badge-warning',
                'active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 'out_stock',
                'name_kh' => 'អស់ស្តុក',
                'name_en' => 'Out Stock',
                'css' => 'badge badge-danger',
                'active' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

       
        ExchangeRate::insert([
            [
                'id' => '003a91eb-9d48-464e-b242-82e260feed9e',
                'date' => Carbon::now(),
                'usd' => 1,
                'khr' => 4100,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
        
        $staffs = getBackupData('staffs');
        $this->storeStaff($staffs);
    }

    private function storeExpenseType(){
        $file = json_decode(file_get_contents(base_path('database/seeders/Data/expense_types.json')) , true );
        $data = [];
        foreach ( $file['RECORDS'] as $item ){
            $data []        = [
                'id' => $item['id'],
                'name_kh'=> $item['name_kh'],
                'name_en' => $item['name_en'],
                
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ];

        }

        $chunks = array_chunk( $data , 5000 );
        foreach ( $chunks as $chunk ){
            ExpenseType::insert( $chunk );
        }
    }

     private function storeBranch($branches){        
        $data = [];
        foreach ($branches as $item) {        
               $data[] = [
                'id' => $item['id'],                
                'code' => $item['code'],
                'name_kh' => $item['name'],
                'description' => $item['description'],                

                'created_at' => $item['created_at'],
                'updated_at' => $item['updated_at'],
                'deleted_at' => $item['deleted_at'],
            ];          
        }
        $chunks = array_chunk($data, 1000);
        foreach ($chunks as $chunk) {
          Branch::insert($chunk);
        }
    }

    private function storeStaff($staffs){        
        $data = [];
        foreach ($staffs as $item) {        
               $data[] = [
                'id' => $item['id'],                
                // 'code' => $item['code'],
                'name_en' => $item['name_en'],
                'name_kh' => $item['name_kh'],
                'sex' => $item['sex'],
                'date_of_birth' => $item['date_of_birth'],
                'phone_number' => $item['phone_number'],
                'start_work_date' => $item['start_work_date'],
                'status' => $item['status'],
                'branch_id' => $item['branch_id'],

                'created_at' => $item['created_at'],
                'updated_at' => $item['updated_at'],
                'deleted_at' => $item['deleted_at'],
            ];          
        }
        $chunks = array_chunk($data, 1000);
        foreach ($chunks as $chunk) {
          Staff::insert($chunk);
        }
    }       
}
