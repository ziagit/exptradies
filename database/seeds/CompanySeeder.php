<?php

use App\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::truncate();
        $users = [
            [
                'email' => 'admin@gmail.com',
                'phone' => '+61 459 437 115',
                'abn'=>'75656873755',
                'acn'=>'656873755',
                'address'=>'Unit 1/71 harrow rd Auburn NSW 2144, Sydney, Australia',
                'gst'=>30.0,
                'acceptable_by'=>3
            ],
        ];
        Company::insert($users);
    }
}
