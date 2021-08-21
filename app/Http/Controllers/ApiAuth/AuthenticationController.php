<?php

namespace App\Http\Controllers\ApiAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Void_;

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

        ])
    }
}
