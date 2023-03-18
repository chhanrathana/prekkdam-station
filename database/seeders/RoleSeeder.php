<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Apps\Role;
use App\Models\Apps\Permission;
use App\Models\Apps\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name'      => 'dashboard',  
                'name_kh'   => 'ព័ត៌មានទូទៅ',
                'sort'      => 1,
            ],

            [
                'name'      => 'chart-age',  
                'name_kh'   => 'ក្រាភិច (ក្រាប):តាមអាយុ',
                'sort'      => 2,
            ],
            [
                'name'      => 'chart-degree',  
                'name_kh'   => 'ក្រាភិច (ក្រាប) :តាមសញ្ញាប័ណ្ណ',
                'sort'      => 3,
            ],
            [
                'name'      => 'chart-salary-rank',  
                'name_kh'   => 'ក្រាភិច (ក្រាប):តាមកាំបៀវត្សរ៍',
                'sort'      => 4,
            ],
            [
                'name'      => 'chart-sex',  
                'name_kh'   => 'ក្រាភិច (ក្រាប):តាមភេទ',
                'sort'      => 5,
            ],
            [
                'name'      => 'chart-duration-of-service',  
                'name_kh'   => 'ក្រាភិច (ក្រាប):រយៈពេលបំពេញការងារ',
                'sort'      => 6,
            ],
            [
                'name'      => 'chart-province',  
                'name_kh'   => 'ក្រាភិច (ក្រាប):តាមខេត្តកំណើត',
                'sort'      => 7,
            ],

            [
                'name'      => 'staff-report-list',
                'name_kh'   => 'ស្ថិតិ ៖ ស្ថិតិិមន្រ្តីរាជការ',
                'sort'      => 8,
            ],
            [
                'name'      => 'staff-yearly-leave',
                'name_kh'   => 'ស្ថិតិ ៖ ច្បាប់-បេសកកម្ម',
                'sort'      => 9,
            ],
            [
                'name'      => 'statistic-staff-major',
                'name_kh'   => 'ស្ថិតិ ៖ ស្ថិតិមន្រ្តីជំនាញ',
                'sort'      => 10,
            ],
            [
                'name'      => 'statistic-staff-medal',
                'name_kh'   => 'ស្ថិតិ ៖ ស្ថិតិឥស្សរិយយស',
                'sort'      => 11,
            ],
            [
                'name'      => 'mission-and-permission-monthly',
                'name_kh'   => 'វត្តមាន ៖ ប្រចាំខែ',
                'sort'      => 12,
            ],
            [
                'name'      => 'mission-and-permission-daily',
                'name_kh'   => 'វត្តមាន ៖ ប្រចាំថ្ងៃ',
                'sort'      => 13,
            ],
            ///
            [
                'name'      => 'report-gate-gate',
                'name_kh'   => 'ច្រកសុវត្ថិភាព ៖ ស្ថិតិ',
                'sort'      => 14,
            ],
            [
                'name'      => 'report-gate-trend',
                'name_kh'   => 'ច្រកសុវត្ថិភាព ៖ ក្រាប',
                'sort'      => 15,
            ],
            [
                'name'      => 'report-gate-track',
                'name_kh'   => 'ច្រកសុវត្ថិភាព ៖ តាមដាន',
                'sort'      => 16,
            ],
            ///
            [
                'name'      => 'staff-leave',
                'name_kh'   => 'ច្បាប់-បេសកកម្ម ៖ តារាង',
                'sort'      => 17,
            ],
            [
                'name'      => 'staff-leave-request',
                'name_kh'   => 'ច្បាប់-បេសកកម្ម ៖ ស្នើសុំ',
                'sort'      => 18,
            ],
            [
                'name'      => 'staff-info',
                'name_kh'   => 'ព័ត៌មានបុគ្គលិក ៖ តារាង',
                'sort'      => 19,
            ],
            [
                'name'      => 'staff-info-create',
                'name_kh'   => 'ព័ត៌មានបុគ្គលិក ៖ បញ្ចូលថ្មី',
                'sort'      => 20,
            ],
            [
                'name'      => 'staff-info-create-cv',
                'name_kh'   => 'ព័ត៌មានបុគ្គលិក ៖ បង្កើតប្រវត្តិរូបសង្ខេប',
                'sort'      => 21,
            ],
            [
                'name'      => 'staff-card',
                'name_kh'   => 'បោះពុម្ភប័ណ្ណ ៖ បោះពុម្ព',
                'sort'      => 22,
            ],
            [
                'name'      => 'staff-card-logs',
                'name_kh'   => 'បោះពុម្ភប័ណ្ណ ៖ កំណត់ហេតុប័ណ្ណបោះពុម្ព',
                'sort'      => 23,
            ],
            [
                'name'      => 'staff-delete',
                'name_kh'   => 'លុបឈ្មោះ ៖ តារាង',
                'sort'      => 24,
            ],
            [
                'name'      => 'staff-delete-request',
                'name_kh'   => 'លុបឈ្មោះ ៖ ស្នើសុំ',
                'sort'      => 25,
            ],
            [
                'name'      => 'staff-free',
                'name_kh'   => 'ទំនេរគ្មានបៀវត្សរ៍ ៖ តារាង',
                'sort'      => 26,
            ],
            [
                'name'      => 'staff-free-request',
                'name_kh'   => 'ទំនេរគ្មានបៀវត្សរ៍ ៖ ស្នើសុំ',
                'sort'      => 27,
            ],
            [
                'name'      => 'staff-retire',
                'name_kh'   => 'ចូលនិវត្ត៍ ៖ តារាង',
                'sort'      => 28,
            ],
            [
                'name'      => 'staff-retire-request',
                'name_kh'   => 'ចូលនិវត្ត៍ ៖ ស្នើសុំ',
                'sort'      => 29,
            ],
            [
                'name'      => 'staff-rank',
                'name_kh'   => 'តម្លើងកាំបៀវត្សរ៍ ៖ តារាង',
                'sort'      => 30,
            ],
            [
                'name'      => 'staff-rank-request',
                'name_kh'   => 'តម្លើងកាំបៀវត្សរ៍ ៖ ស្នើសុំ',
                'sort'      => 31,
            ],
            [
                'name'      => 'staff-position',
                'name_kh'   => 'តែងតាំង ៖ តារាង',
                'sort'      => 32,
            ],
            [
                'name'      => 'staff-position-request',
                'name_kh'   => 'តែងតាំង ៖ ស្នើសុំ',
                'sort'      => 33,
            ],


            [
                'name'      => 'setting-device',
                'name_kh'   => 'កំណត់ ៖ ម៉ាស៊ីនស្កែន',
                'sort'      => 34,
            ],
            [
                'name'      => 'setting-pushdevice',
                'name_kh'   => 'កំណត់ ៖ រុញទិន្នន័យ',
                'sort'      => 35,
            ],
            [
                'name'      => 'setting-telegram',
                'name_kh'   => 'កំណត់ ៖ តេឡេក្រាម',
                'sort'      => 36,
            ],
            [
                'name'      => 'setting-office',
                'name_kh'   => 'កំណត់ ៖ អង្គភាព',
                'sort'      => 37,
            ],
            [
                'name'      => 'setting-position',
                'name_kh'   => 'កំណត់ ៖ តួនាទី',
                'sort'      => 38,
            ],
            [
                'name'      => 'setting-salary-rank',
                'name_kh'   => 'កំណត់ ៖ កាំបៀវត្សរ៍',
                'sort'      => 39,
            ],
            [
                'name'      => 'setting-language',
                'name_kh'   => 'កំណត់ ៖ ភាសា',
                'sort'      => 40,
            ],
            [
                'name'      => 'setting-framwork-category',
                'name_kh'   => 'កំណត់ ៖ ក្របខ័ណ្ណ',
                'sort'      => 41,
            ],
            [
                'name'      => 'setting-education-level',
                'name_kh'   => 'កំណត់ ៖ កំរិតសញ្ញាប័ត្រ',
                'sort'      => 42,
            ],
            [
                'name'      => 'setting-skill',
                'name_kh'   => 'កំណត់ ៖ កំរិតជំនាញ',
                'sort'      => 43,
            ],
            [
                'name'      => 'setting-medal',
                'name_kh'   => 'កំណត់ ៖ ឥស្សរិយយស',
                'sort'      => 44,
            ],
            [
                'name'      => 'setting-ministry',
                'name_kh'   => 'កំណត់ ៖ ព័ត៍មានអំពីក្រសួង',
                'sort'      => 45,
            ],
            [
                'name'      => 'user',
                'name_kh'   => 'ការប្រើប្រាស់ ៖ អ្នកប្រើប្រាស់',
                'sort'      => 46,
            ],
            [
                'name'      => 'group-role',
                'name_kh'   => 'ការប្រើប្រាស់ ៖ ក្រុមសិទ្ធិ',
                'sort'      => 47,
            ],
         ];
        $sysRole  = new Role();
        $sysRole->name = config('permission.prefix.system')."ADMIN";
        $sysRole->name_kh = "ADMIN";
        $sysRole->guard_name = 'web';
        $sysRole->save();

        foreach ( $roles as $role ){
            $newRole  = new Role();
            $newRole->sort = $role['sort'];
            $newRole->name = config('permission.prefix.menu').$role['name'];
            $newRole->name_kh = $role['name_kh'];
            $newRole->guard_name = 'web';
            $newRole->save();
            # create for permission
            # then assign permission to the created role
            $permissions = ['create:','read:','update:','delete:'];
            foreach ( $permissions as $key => $permission ){
                $newPermission = new Permission();
                $newPermission->id = $key.\Illuminate\Support\Str::random(30);
                $newPermission->name =  $permission.$role['name'];
                $newPermission->guard_name = "web";
                $newPermission->save();
                \Illuminate\Support\Facades\DB::table('role_has_permissions')->insert([
                    'permission_id' => $newPermission->id,
                    'role_id'       => $newRole->id,
                ]);

                # ASSIGN PERMISSION TO ROLE ADMIN
                \Illuminate\Support\Facades\DB::table('role_has_permissions')->insert([
                    'permission_id' => $newPermission->id,
                    'role_id'       => $sysRole->id,
                ]);
            }
        }
        $user =  User::all();
        foreach ($user as $key => $value) {
             # ASSIGN ROLE ADMIN TO USER 0969640495
            \Illuminate\Support\Facades\DB::table('user_has_roles')->insert([
                'role_id'           => $sysRole->id,
                'model_type'        => User::class,
                'model_uuid'        => $value->id
            ]);
        }
       
    }

}
