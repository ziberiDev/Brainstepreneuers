<?php

use App\Http\Controllers\ApiAuth\AuthenticationController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    // logout
    Route::post('/logout', [AuthenticationController::class, 'logout']);

    // User
    Route::get('/me', [UserController::class, 'me']);
    Route::get('/user/{user}', [UserController::class, 'index']);
    Route::post('/me/update', [UserController::class, 'update']);

    // User Projects
    Route::get('/me/projects', [ProjectController::class, 'userprojects']);
    Route::post('/user/project/create', [ProjectController::class, 'store']);
    Route::post('/project/{id}/apply', [ProjectController::class, 'apply']);
    Route::post('/project/{project}/assemble', [ProjectController::class, 'assemble']);

    //Projects
    Route::get('/projects/{accademy}' , [ProjectController::class , 'index']); // filter for all aprojects by accademy
    Route::get('/project/{project}', [ProjectController::class , 'show']);
    Route::post('/project/{project}/update', [ProjectController::class, 'update']);
    Route::delete('/project/{project}/delete', [ProjectController::class, 'delete']);
});
