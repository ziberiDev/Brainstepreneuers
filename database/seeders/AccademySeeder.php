<?php

namespace Database\Seeders;

use App\Models\Accademy;
use Illuminate\Database\Seeder;

class AccademySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accademies = [
            ['name' => 'Backend Development'],
            ['name' => 'Frontend Development'],
            ['name' => 'Marketing'],
            ['name' => 'Data Science'],
            ['name' => 'Design'],
            ['name' => 'QA'],
            ['name' => 'UX/UI']
        ];

        Accademy::insert($accademies);
    }
}
