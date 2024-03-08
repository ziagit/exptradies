<?php

use App\Step;
use Illuminate\Database\Seeder;

class StepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Step::truncate();
        $cities = [
            [
                'title' => "When work should be started?",
                'details' => "",
                'value' => null,
                'service_id' => 1,
            ],

            [
                'title' => "What is the type of tiling?",
                'details' => "",
                'value' => null,
                'service_id' => 1
            ],
            [
                'title' => "Have you purchased the tiles yet?",
                'details' => "",
                'value' => null,
                'service_id' => 1
            ],
            [
                'title' => "Which area you need to tile?",
                'details' => "",
                'value' => null,
                'service_id' => 1
            ],
            [
                'title' => "What is the rough size in sqr?",
                'details' => "",
                'value' => null,
                'service_id' => 1
            ],
            [
                'title' => "What is the status of your job?",
                'details' => "",
                'value' => null,
                'service_id' => 1
            ],
         

            
        ];
        Step::insert($cities);
    }
}
