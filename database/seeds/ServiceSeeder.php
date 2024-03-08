<?php

use App\Service;
use App\ServiceType;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            [
                'name' => "Tiler",
                'image' => null,
                'type' => ServiceType::where('id',1)->first()->name,
                'details' => "We are here to assist you achieve the best finish and level of satisfaction even though tiling is a specialized job that calls for a lot of preparation, expertise, and professions. Whether you're tiling the floor, a shower, a kitchen splash back, a fireplace, or other smaller places that call for greater expertise. We are here to recommend the most skilled tradespeople that can make your life more enjoyable and help you accomplish outstanding outcomes.
                From surface preparation through diverse techniques for tilling floors, walls, and other places until the finish of projects, the exptradies professionals team is ready to accomplish.",
            ],
            [
                'name' => "Lawn Care",
                'image' => null,
                'type' => ServiceType::where('id',2)->first()->name,
                'details' => "We are here to assist you achieve the best finish and level of satisfaction even though tiling is a specialized job that calls for a lot of preparation, expertise, and professions. Whether you're tiling the floor, a shower, a kitchen splash back, a fireplace, or other smaller places that call for greater expertise. We are here to recommend the most skilled tradespeople that can make your life more enjoyable and help you accomplish outstanding outcomes.
                From surface preparation through diverse techniques for tilling floors, walls, and other places until the finish of projects, the exptradies professionals team is ready to accomplish.",
            ],
            [
                'name' => "Office Cleaning",
                'image' => null,
                'type' => ServiceType::where('id',3)->first()->name,
                'details' => "We are here to assist you achieve the best finish and level of satisfaction even though tiling is a specialized job that calls for a lot of preparation, expertise, and professions. Whether you're tiling the floor, a shower, a kitchen splash back, a fireplace, or other smaller places that call for greater expertise. We are here to recommend the most skilled tradespeople that can make your life more enjoyable and help you accomplish outstanding outcomes.
                From surface preparation through diverse techniques for tilling floors, walls, and other places until the finish of projects, the exptradies professionals team is ready to accomplish.",
            ],
        ];
        Service::insert($cities);
    }
}
