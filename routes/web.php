<?php

use App\Models\User;
use App\Models\Project;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\ProjectResource;
use Illuminate\Database\Eloquent\Builder;

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
    
     $a = Project::whereHas('accademies' , function(Builder $query) {
         $query->where('accademy_id' , 2);
     })->with('accademies')->get();
return $a;
    });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');



// require __DIR__.'/auth.php';
