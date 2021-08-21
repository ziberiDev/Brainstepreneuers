<?php

namespace Database\Seeders;

use App\Models\ProjectApplication;
use Illuminate\Database\Seeder;

class ProjectApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectApplication::factory(50)->create();
    }
}
