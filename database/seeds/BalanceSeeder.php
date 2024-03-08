<?php

use App\Balance;
use Illuminate\Database\Seeder;

class BalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Balance::truncate();
        $balance = [
            [
                'percentage' => 50, //%
                'discount'=> 10, //%
                'min_balance'=>50 //$
            ],
        ];
        Balance::insert($balance);
    }
}
