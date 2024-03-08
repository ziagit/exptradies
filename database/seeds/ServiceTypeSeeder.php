<?php

use App\ServiceType;
use Illuminate\Database\Seeder;

class ServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            ['name' => 'Home Repairs and Maintenance'],
            ['name' => 'Outdoor Maintenance'],
            ['name' => 'Business Services'],
        ];
        ServiceType::insert($cities);
    }
}
