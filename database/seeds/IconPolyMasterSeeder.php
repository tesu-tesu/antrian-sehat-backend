<?php

use App\PolyMaster;
use Illuminate\Database\Seeder;

class IconPolyMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $polymasters = PolyMaster::all();

        $fileNames = ['medic_checklist.png', 'momkid.png', 'dentist.png', 'balita.png', 'nutrition_check.png', 'lungs.png', 'manula.png', 'eye.png', 'Lab.png'];

        foreach ($polymasters as $i => $polymaster) {
            $isUpdate = PolyMaster::where('id', $polymaster->id)
                ->update([
                    'image' => $fileNames[$i]
                ]);
        }
    }
}
