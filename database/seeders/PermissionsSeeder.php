<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Apps\Role;
use App\Models\Apps\Permission;
use App\Models\Apps\User;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
class PermissionsSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);
        Permission::create(['name' => 'publish articles']);
        Permission::create(['name' => 'unpublish articles']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'writer']);
        $role1->givePermissionTo('edit articles');
        $role1->givePermissionTo('delete articles');

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('publish articles');
        $role2->givePermissionTo('unpublish articles');

        $role3 = Role::create(['name' => 'super-admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users

        // $user = factory(App\Models\Apps\User::class)->create([
        //     'name' => 'Example User',
        //     'email' => 'test@example.com',
        // ]);
        $user = User::create([
            'name' => 'Example User',
            'email' => 'test@example.com',
        ]);
      
        // $user = User::factory()->create([
        //     'name' => 'Example User',
        //     'email' => 'test@example.com',
        // ]);
        $user->assignRole($role1);

        // $user = factory(App\Models\Apps\User::class)->create([
        //     'name' => 'Example Admin User',
        //     'email' => 'admin@example.com',
        // ]);

        $user = User::create([
            'name' => 'Example Admin User',
            'email' => 'admin@example.com',
        ]);

        // $user = User::factory()->create([
        //     'name' => 'Example Admin User',
        //     'email' => 'admin@example.com',
        // ]);
        $user->assignRole($role2);


        // $user = factory(App\Models\Apps\User::class)->create([
        //     'name' => 'Example Super-Admin User',
        //     'email' => 'superadmin@example.com',
        // ]);
        $user = User::create([
            'name' => 'Example Super-Admin User',
            'email' => 'superadmin@example.com',
        ]);
        // $user = User::factory()->create([
        //     'name' => 'Example Super-Admin User',
        //     'email' => 'superadmin@example.com',
        // ]);
        $user->assignRole($role3);
    }
}