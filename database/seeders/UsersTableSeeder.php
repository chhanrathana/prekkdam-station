<?php

namespace Database\Seeders;

use App\Models\URL;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserType;
use App\Models\UserTypeURL;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    //     UserType::insert([
    //        [
    //        'id' => 1,
    //        'name' => 'Admin user',
    //        'is_admin' => '1',
    //        'created_at' => Carbon::now(),
    //        'updated_at' => Carbon::now(),
    //        ],
    //        [
    //        'id' => 0,
    //        'name' => 'Normal user',
    //        'is_admin' => '0',
    //        'created_at' => Carbon::now(),
    //        'updated_at' => Carbon::now(),
    //        ]]
    //    );
       
   
    //     // $2y$10$CAHAXNRqlW88wc2Cf8vmBe1fzouwco7Q8cB7fNuSGQtUbo0Anplt6

        $userTypes = getBackupData('user_types');
        $this->storeUserTypes($userTypes);
        
        // users
        $users = getBackupData('users');        
        $this->storeUser($users);

        User::insert([
            'id' => Str::uuid(),
            'name_kh' => 'test',
            'email' => 'test',
            'is_admin' => '1',
            'user_type_id' => '1',
            'password' => Hash::make('FA4257->tPHZBW<P'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $this->storeUrls();

        $url = getBackupData('user_type_urls');
        $this->storeUserTypeUrl($url);
    }

    private function storeUserTypes($userTypes){
        $data = [];
        foreach ($userTypes as $item) {
               $data[] = [
                'id' => $item['id'],
                'is_admin' => $item['is_admin'],
                'name_kh' => $item['name'],
                'is_admin' => $item['is_admin'],
                
                'created_at' => $item['created_at'],
                'updated_at' => $item['updated_at'],
                // 'deleted_at' => $item['deleted_at'],
            ];          
        }
        $chunks = array_chunk($data, 1000);
        foreach ($chunks as $chunk) {
          UserType::insert($chunk);
        }
    }

    private function storeUser($users){
        $data = [];
        foreach ($users as $item) {
               $data[] = [
                'id' => $item['id'],
                'name_kh' => $item['name'],
                'email' => $item['email'],
                'is_admin' => $item['is_admin'],
                'user_type_id' => $item['user_type_id'],
                'email_verified_at' => $item['email_verified_at'],
                'password' => $item['password'],                
                'branch_id' => $item['branch_id'],

                'created_at' => $item['created_at'],
                'updated_at' => $item['updated_at'],
                'deleted_at' => $item['deleted_at'],
            ];          
        }
        $chunks = array_chunk($data, 1000);
        foreach ($chunks as $chunk) {
          User::insert($chunk);
        }
    }

    private function storeUrls(){
        $files = json_decode(file_get_contents(base_path('database/seeders/Data/urls.json')) , true );
        $data               = [];        
        foreach ( $files['RECORDS'] as $file ){
            $data [] = [
                'id' => $file['id'],
                'method'=> $file['method'],
                'uri' => $file['uri'],
                'route_name' => $file['route_name'],
                'is_menu' => (boolean) $file['is_menu'],
                'acitve' => (boolean) $file['acitve'],
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ];

        }

        $chunks = array_chunk( $data , 5000 );
        foreach ( $chunks as $chunk ){
            URL::insert( $chunk );
        }
    }

    private function storeUserTypeUrl($users){
        $data = [];
        foreach ($users as $item) {
               $data[] = [
                'user_type_id' => $item['user_type_id'],
                'url_id' => $item['url_id']
            ] ;
        }
        $chunks = array_chunk($data, 1000);
        foreach ($chunks as $chunk) {
          UserTypeURL::insert($chunk);
        }
    }
}
