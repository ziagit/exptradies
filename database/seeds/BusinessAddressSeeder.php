<?php

use App\Address;
use App\BusinessAddress;
use Illuminate\Database\Seeder;

class BusinessAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BusinessAddress::truncate();
        $address = [
            [
                'address'=>"201 Sussex St, Sydney NSW 2000, Australia",
                'range'=>50,
                'employee_id'=>1,
            ]

        ];
        BusinessAddress::insert($address);
    }
}
