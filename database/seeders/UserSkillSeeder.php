<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\UserSkill;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;

class UserSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all()->each(function ($user) {
            for ($i = 0; $i < 3; $i++) {

                UserSkill::create([
                    "user_id" => $user->id,
                    "skill_id" => Skill::inRandomOrder()->first()->id
                ]);
            }
        });
    }
}
