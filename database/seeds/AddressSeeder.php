<?php

use App\Address;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Address::truncate();
        $address = [
            [
                'country' => 'Australia',
                'state' => 'NSW',
                'city' => "Sydney",
                'zip' => '2000',
                'street'=>"Sussex Street",
                'street_number'=>"201",
                'formatted_address'=>"201 Sussex St, Sydney NSW 2000, Australia"
            ]

        ];
        Address::insert($address);
    }
}
