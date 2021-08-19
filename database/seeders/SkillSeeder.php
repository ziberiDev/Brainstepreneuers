<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $row = 1;
        $handle = fopen(public_path('skills.csv'), "r");
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $num = count($data);
                $row++; 
                if ($row > 2) {
                        for ($c=0; $c < $num; $c++) {
                        Skill::create(['name' => $data[$c]]);
                    }
                }
        }
        fclose($handle);
    }
}
