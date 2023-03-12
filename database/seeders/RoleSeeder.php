<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->roles() as  $role){
            Role::create([
                'name' =>$role
            ]);
        }
    }

    private function  roles() : array
    {
        return  [
            'Super Admin',
            'Content Writer'
        ];
    }
}