<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::create(['name' => 'Super Admin']);

        User::find(1)->assignRole($superAdmin);

        $editor = Role::create(['name' => 'Editor']);

        $editor = User::find(2)->assignRole($editor);

        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'delete user']);

    }

}

//public function run(): void
//{
//    foreach ($this->roles() as  $role){
//        Role::create([
//            'name' =>$role
//        ]);
//    }
//}
//
//private function  roles() : array
//{
//    return  [
//        'Super Admin',
//        'Content Writer'
//    ];
//}
