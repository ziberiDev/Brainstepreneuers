<?php

namespace App\Http\Controllers\ApiAuth;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Cache\Store;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\Step1Request;
use App\Http\Requests\Auth\Step2Request;
use App\Http\Requests\Auth\Step3Request;
use App\Http\Requests\Auth\RegisterRequest;
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
        auth()->user()->tokens()->delete();
        return response()->json([
            'auth_token' => auth()->user()->createToken('auth_token')->plainTextToken,
            'user_id' => auth()->user()->id
        ]);
    }

    /**
     * Logout function
     */
    public function  logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return [
            'message' => 'Tokens Revoked'
        ];
    }

    public function step_1(Step1Request $request)
    {
        $user = auth()->user();
        //  return response()->json(var_dump($user));

        $user->update([
            'accademy_id' => $request->accademy_id,
            'step' => 2
        ]);

        return response('accademy set');
    }
    public function step_2(Step2Request $request)
    {
        // return $request->all();
        $user = auth()->user();
        if (!$this->service->userSkills($user->id, $request->skills)) {
            return abort(427, "Something went wrong");
        }
        //  return response()->json(var_dump($user));

        $user->update([
            'step' => 3
        ]);
        return response('Skills set');
    }
    public function step_3(Step3Request $request)
    {
        // return $request->all();
        $user = auth()->user();
        $imagepath = $this->service->uploadImage($request->image);
        if (!$imagepath) {
            return response("image Upload failed", 400);
        };
        $user->update([
            'image' => $imagepath,
            'registered' => 1
        ]);
        return response('Image uploaded set');
    }
}
