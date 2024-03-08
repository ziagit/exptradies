<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
        $roles = [
            [
                'name'=>'Admin',
            ],
            [
                'name'=>'Support',
            ],
            [
                'name'=>'Employee',
            ],
            [
                'name'=>'Employer',
            ],
            [
                'name'=>'Guest',
            ]
            ];
            Role::insert($roles);
    }
}
