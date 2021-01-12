<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => "Mas Super Admin",
                'email' => "sa@sa.com",
                'password' => Hash::make('password'),
                'phone' => "123456789012",
                'role' => "Super Admin",
                'health_agency_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => "Mbak Admin",
                'email' => "a@a.com",
                'password' => Hash::make('password'),
                'phone' => "210987654321",
                'role' => "Admin",
                'health_agency_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
