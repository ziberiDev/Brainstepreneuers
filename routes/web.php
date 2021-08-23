<?php

use App\Http\Resources\ProjectResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return ProjectResource::collection(Project::all()->fresh(['owner' ,'applications']));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');



// require __DIR__.'/auth.php';
