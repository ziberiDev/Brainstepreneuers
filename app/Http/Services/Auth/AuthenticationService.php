<?php

namespace App\Http\Services\Auth;

use App\Models\UserSkill;

class AuthenticationService
{

    /**
     * upload image of user
     * 
     * @return string|false 'the saved image filename or false on fail'
     */
    public function uploadImage($image): string
    {
        $imageName = substr(sha1(mt_rand()), 17, 15) . '.' . $image->extension();

        if ($image->storeAs('public/images', $imageName)) {
            return $imageName;
        }
        return false;
    }

    /**
     * Insert user skills into database
     * 
     * @param int  $userId "the id of the created user"
     * @param array  $skills "the skills array from the request of the created user"
     * 
     * @return bool "on succes  true else false"
     */
    public function userSkills(int $userId, array $skills):bool
    {
        foreach ($skills as $skill_id) {
            $userSkill =  UserSkill::create([
                'user_id' => $userId,
                'skill_id' => $skill_id
            ]);

            if (!$userSkill)
                return false;
        }

        return true;
    }
}
