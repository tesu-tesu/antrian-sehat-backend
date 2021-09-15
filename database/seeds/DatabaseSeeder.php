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
        $this->call(PolyMasterSeeder::class);
//        $this->call(IconPolyMasterSeeder::class);
        $this->call(HealthAgencySeeder::class);
        $this->call(UserSeeder::class);
    }
}
