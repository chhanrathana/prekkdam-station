<?php
namespace Database\Seeders;

use App\Models\Apps\User as AppsUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $users[] =[
            'id'                => Str::uuid()->toString(),
            'name'              => 'DEVELOPER',
            'phone'             => 'admin',
            'email'             => 'admin',
            'password'          => Hash::make('@itPR4MPWT'),
            'password_expire_at' => Carbon::now()->addYear(1),            
        ];

        $chunks = array_chunk($users, 5000);
        foreach ($chunks as $chunk) {
            AppsUser::insert($chunk);
        }
    }
}
