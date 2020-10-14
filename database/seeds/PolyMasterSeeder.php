<?php

use Illuminate\Database\Seeder;
use App\PolyMaster;

class PolyMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Model::unguard();

        $dml = PolyMaster::create([
            'name' => 'Poli Umum',
        ]);
        $dml = PolyMaster::create([
            'name' => 'Poli Ibu dan Anak',
        ]);
        $dml = PolyMaster::create([
            'name' => 'Poli Gigi',
        ]);
        $dml = PolyMaster::create([
            'name' => 'Poli Balita',
        ]);
        $dml = PolyMaster::create([
            'name' => 'Poli Gizi',
        ]);
        $dml = PolyMaster::create([
            'name' => 'Poli TBC',
        ]);
        $dml = PolyMaster::create([
            'name' => 'Poli Lansia',
        ]);
        $dml = PolyMaster::create([
            'name' => 'Poli Optik',
        ]);
        $dml = PolyMaster::create([
            'name' => 'Laboratorium',
        ]);
    }
}
