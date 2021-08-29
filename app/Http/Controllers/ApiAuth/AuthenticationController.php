<?php

namespace App\Http\Controllers\ApiAuth;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Cache\Store;
use App\Http\Requests\Auth\LoginRequest;
use phpDocumentor\Reflection\Types\Void_;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\Step1Request;
use App\Http\Services\Auth\AuthenticationService;

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
        // //  Upload user image
        // if ($request->file('image')) {
        //     $imagepath = $this->service->uploadImage($request->image);
        //     if ($imagepath)
        //         return abort(424, 'Failed to load image');
        // } else {
        //     $imagepath = 'default-user-image.png';
        // }
        // create user
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            // 'accademy_id' => $request->accademy_id,
            'biography' => $request->biography,
            // 'image' => $imagepath,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        if ($user) {
            // if (!$this->service->userSkills($user->id, explode(",", trim($request->skills, "[]")))) {
            //     return abort(427, "Something went wrong");
            // }
            // if everything is done return auth token
            return response()->json([
                'auth_token' => $user->createToken('auth_token')->plainTextToken,
                'user_id' => $user->id
            ]);
        }
    }

    /**
     * Login user and return auth token
     *  @param \App\Http\Requests\Auth\LoginRequest $request
     */
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->all())) {
            return abort(401, 'Credentials not match');
        }
        return response()->json([
            'auth_token' => auth()->user()->createToken('auth_token')->plainTextToken,
            'user_id' => auth()->user()->id
        ]);
    }

    /**
     * Logout function
     */
    public function  logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }

    public function step_1(Step1Request $request)
    {
        $user = auth()->user();
    //  return response()->json(var_dump($user));

        $user->update($request->all());

        return response('accademy set');
    }
}
