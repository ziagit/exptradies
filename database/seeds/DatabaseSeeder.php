<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CompanySeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AddressSeeder::class);
        $this->call(BusinessAddressSeeder::class);
        $this->call(ServiceTypeSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(StepSeeder::class);
        $this->call(OptionSeeder::class);
        $this->call(SuboptionSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(AboutSeeder::class);
        $this->call(EmployeeFaqSeeder::class);
        $this->call(EmployerFaqSeeder::class);
        $this->call(PrivacySeeder::class);
        $this->call(TermSeeder::class);
        $this->call(CommissionSeeder::class);
        $this->call(BalanceSeeder::class);
        $this->call(BlogSeeder::class);
    }
}
