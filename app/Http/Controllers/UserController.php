<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $id the users id
     * @return \Illuminate\Http\Response
     */
    public function index(int $id)
    {
        return new UserResource(User::with('accademy', 'skills')->findOrFail($id));
    }

    /**
     * Get the loged in user
     */
    public function me()
    {

        return response()->json(
            new UserResource(
                User::with('accademy')->findOrFail(auth()->user()->id)
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request)
    {
        $user = User::findOrFail(auth()->user()->id);

        $user->update($request->all());
        // check if update and return response 
    }
}
