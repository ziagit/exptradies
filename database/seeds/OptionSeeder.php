<?php

use App\Option;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Option::truncate();
        $cities = [
            [
                'title' => "Emergency",
                'details' => "",
                'value' => null,
                'step_id' => 1,
            ],

            [
                'title' => "ASAP",
                'details' => "",
                'value' => null,
                'step_id' => 1,
            ],
            [
                'title' => "Next few days",
                'details' => "",
                'value' => null,
                'step_id' => 1,
            ],
            [
                'title' => "I'm flexible",
                'details' => "",
                'value' => null,
                'step_id' => 1,
            ],
            [
                'title' => "Replace existing tiles",
                'details' => "",
                'value' => null,
                'step_id' => 2,
            ],
            [
                'title' => "Repair existing tiles",
                'details' => "",
                'value' => null,
                'step_id' => 2,
            ],
            [
                'title' => "Lay new tiles",
                'details' => "",
                'value' => null,
                'step_id' => 2,
            ],
            [
                'title' => "Yes",
                'details' => "",
                'value' => null,
                'step_id' => 3,
            ],
            [
                'title' => "No",
                'details' => "",
                'value' => null,
                'step_id' => 3,
            ],
            [
                'title' => "Floor",
                'details' => "",
                'value' => null,
                'step_id' => 4,
            ],
            [
                'title' => "Shower/Bath",
                'details' => "",
                'value' => null,
                'step_id' => 4,
            ],
            [
                'title' => "Wall",
                'details' => "",
                'value' => null,
                'step_id' => 4,
            ],
            [
                'title' => "Splashback",
                'details' => "",
                'value' => null,
                'step_id' => 4,
            ],
            [
                'title' => "Less than 5 sqm",
                'details' => "",
                'value' => null,
                'step_id' => 5,
            ],
            [
                'title' => "5 - 20 sqm",
                'details' => "",
                'value' => null,
                'step_id' => 5,
            ],
            [
                'title' => "20 - 50 sqm",
                'details' => "",
                'value' => null,
                'step_id' => 5,
            ],
            [
                'title' => "Ready to hire",
                'details' => "",
                'value' => null,
                'step_id' => 6,
            ],
            [
                'title' => "Planning & Budgeting",
                'details' => "",
                'value' => null,
                'step_id' => 6,
            ],
           
        ];
        Option::insert($cities);
    }
}
