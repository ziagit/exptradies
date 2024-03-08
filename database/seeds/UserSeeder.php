<?php

use App\Role;
use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $users = [
            [
                'name' => 'Admin',
                'email' => 'support@exptradies.com',
                'phone' => '+61233456789',
                'password' => Hash::make('123'),
                'email_verified_at'=> Carbon::now()
            ],
            [
                'name' => 'Support',
                'email' => 'exptradies@gmail.com',
                'phone' => '+61233456788',
                'password' => Hash::make('123'),
                'email_verified_at'=> Carbon::now()
            ],
            [
                'name' => 'Employee A',
                'email' => 'employee@gmail.com',
                'phone' => '+61223456787',
                'password' => Hash::make('123'),
                'email_verified_at'=> Carbon::now()
            ],
            [
                'name' => 'Employee B',
                'email' => 'employer@gmail.com',
                'phone' => '+61223456780',
                'password' => Hash::make('123'),
                'email_verified_at'=> Carbon::now()
            ]
        ];
        User::insert($users);

        $admin = User::find(1);
        $adminRole = Role::where('name', 'Admin')->first();
        $admin->roles()->attach($adminRole);

        $support = User::find(2);
        $supportRole = Role::where('name', 'Support')->first();
        $support->roles()->attach($supportRole);

        $traderRole = Role::where('name', 'Employee')->first();
        $trader = User::find(3);
        $trader->roles()->attach($traderRole);

        $trade = User::find(4);
        $trade->roles()->attach($traderRole);
    }
}
