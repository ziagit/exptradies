<?php

use App\BusinessAddress;
use App\City;
use App\Employee;
use App\Service;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::truncate();
        $employees = [
            [
                'first_name' => 'Emp first name',
                'last_name' => 'Emp last name',
                'business_abn' => 'ABC12345678',
                'business_name'=>"Exptradies",
                'user_id' => 3,
                'address_id' => 1
            ]
        ];
        Employee::insert($employees);

        $emp1 = Employee::find(1);

        $service = Service::find(1);
        $emp1->services()->attach($service);
       
    }
}
