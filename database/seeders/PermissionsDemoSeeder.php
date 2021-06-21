<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;

class PermissionsDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'all_rights']);
        Permission::create(['name' => 'restricted']);
        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'superadmn']);
        $role1->givePermissionTo('all_rights');
        $role1->givePermissionTo('restricted');

        $role2 = Role::create(['name' => 'user']);
        $role2->givePermissionTo('restricted');




  $user = \App\Models\User::factory()->create([
            'name' => 'ss',
            'lastname'=>'sharma',
            'email' => 'ss@gmail.com',
            'phone'=>'7009825172',
            'password'=>Hash::make('123'),
            'latitude'=>12.124,
            'longitude'=>12.124
        ]);
        $user->assignRole($role1);



    }

}
