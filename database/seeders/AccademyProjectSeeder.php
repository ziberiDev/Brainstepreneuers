<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Accademy;
use App\Models\AccademyProject;
use Illuminate\Database\Seeder;

class AccademyProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Project::all()->each(function ($project) {
            for ($i = 0; $i < rand(1, 3); $i++) {
                AccademyProject::create([
                    'project_id' => $project->id,
                    'accademy_id' => Accademy::inRandomOrder()->first()->id
                ]);
            }
        });
    }
}
