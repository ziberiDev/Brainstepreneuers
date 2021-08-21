<?php

namespace App\Http\Controllers\ApiAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use phpDocumentor\Reflection\Types\Void_;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Services\Auth\AuthenticationService;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    /**
     * service of this controller
     * @property $service
     */
    protected $service;

    public function __construct(AuthenticationService $service)
    {
        $this->service = $service;
    }


    /**
     * The method to register a new user
     * 
     * @param \App\Http\Requests\Auth\RegisterRequest $request
     */
    public function register(RegisterRequest $request)
    {
        dd($request);

        if ($imagepath = $this->service->uploadImage($request->image)) {
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'accademy_id' => $request->accademy_id,
                'biography' => $request->biography,
                'image' => $imagepath,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            if ($user) {
                return [
                    'auth_token' => $user->createToken('auth_token')->plainTextToken,
                    'user_id' => $user->id
                ];
            }
            return abort(424, "Failed to register");
        }

        return abort(424, 'Failed to load image');
    }
}
