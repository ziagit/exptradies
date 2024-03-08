<?php

use Illuminate\Database\Seeder;
use App\Commission;
class CommissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Commission::truncate();
        $cities = [
            [
                'service_id' => 1,
                'service_amount' => 20,
                'km_amount' => 15,
            ],
        ];
        Commission::insert($cities);
    }
}
