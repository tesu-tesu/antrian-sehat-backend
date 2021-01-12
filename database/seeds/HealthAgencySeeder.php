<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class HealthAgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('health_agencies')->insert([
            [
                'name' => "Puskesmas Seeder",
                'address' => "Alamat Seeder",
                'email' => "ps@ps.com",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
