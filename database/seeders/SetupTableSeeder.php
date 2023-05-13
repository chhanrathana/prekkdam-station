<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Sex;
use App\Models\StaffStatus;
use App\Models\ClientStatus;
use App\Models\ClientType;
use App\Models\DepositStatus;
use App\Models\DepositType;
use App\Models\ExpenseType;
use App\Models\LoanStatus;
use App\Models\LoanType;
use App\Models\Staff;
use App\Models\PaymentStatus;

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

        ClientType::insert([
            [
                'id' => 'ind',
                'name_kh' => 'បុគ្គល',
                'name_en' => 'Individual',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 'comm',
                'name_kh' => 'សមាគម',
                'name_en' => 'Community',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
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

        ClientStatus::insert([
            [
                'id' => 'active',
                'name_kh' => 'បើក',
                'name_en' => 'ACTIVE',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 'inactive',
                'name_kh' => 'បិទ',
                'name_en' => 'INACTIVE',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
        LoanType::insert([
            [
                'id' => 'fix',
                'name_kh' => 'កំណត់',
                'name_en' => 'FIX',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 'flexible',
                'name_kh' => 'បត់បែន',
                'name_en' => 'FLIXBLE',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],            
        ]);

        LoanStatus::insert([
            [
                'id' => 'pending',
                'name_kh' => 'កម្ចីថ្មី',
                'name_en' => 'New',
                'css' => 'badge badge-primary',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 'progress',
                'name_kh' => 'ដំណើការ',
                'name_en' => 'Progress',
                'css' => 'badge badge-info',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 'finish',
                'name_kh' => 'បញ្ចប់',
                'name_en' => 'CLOSE',
                'css' => 'badge badge-danger',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        DepositStatus::insert([
            [
                'id' => 'pending',
                'name_kh' => 'សន្សំថ្មី',
                'name_en' => 'New',
                'css' => 'badge badge-primary',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 'progress',
                'name_kh' => 'ដំណើការ',
                'name_en' => 'Progress',
                'css' => 'badge badge-info',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 'finish',
                'name_kh' => 'បញ្ចប់',
                'name_en' => 'CLOSE',
                'css' => 'badge badge-danger',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        DepositType::insert([
            [
                'id' => 'saving',
                'name_kh' => 'សន្សំ',
                'name_en' => 'Saving',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 'deposit',
                'name_kh' => 'បញ្ញើរ',
                'name_en' => 'Depsoit',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],            
        ]);

        PaymentStatus::insert([
            [
                'id' => 'pending',
                'name_kh' => 'មិនទាន់បង់',
                'name_en' => 'PENDING',
                'css' => 'badge badge-info',
                'visible' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 'paid',
                'name_kh' => 'បង់រួច',
                'name_en' => 'PAID',
                'css' => 'badge badge-success',
                'visible' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 'late',
                'name_kh' => 'យឺត',
                'name_en' => 'LATE',
                'css' => 'badge badge-danger',
                'visible' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 'lack',
                'name_kh' => 'បង់ទុក',
                'name_en' => 'LACK',
                'css' => 'badge badge-warning',
                'visible' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 'finish',
                'name_kh' => 'បញ្ចប់',
                'name_en' => 'CLOSE',
                'css' => 'badge badge-danger',
                'visible' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
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
