<?php

namespace App\Http\Services\Auth;



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
}
