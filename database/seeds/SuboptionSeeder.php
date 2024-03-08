<?php

use App\Suboption;
use Illuminate\Database\Seeder;

class SuboptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Suboption::truncate();
        $cities = [
            [
                'title' => "Inside",
                'details' => "",
                'value' => null,
                'option_id' => 1,
            ],

            [
                'title' => "Outside",
                'details' => "",
                'value' => null,
                'option_id' => 1,
            ],
        ];
        Suboption::insert($cities);
    }
}
