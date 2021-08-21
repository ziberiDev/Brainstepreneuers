<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\ProjectApplication;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectApplicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProjectApplication::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'project_id' => Project::inRandomOrder()->first()->id,
            'message' =>$this->faker->text(300),
        ];
    }
}
