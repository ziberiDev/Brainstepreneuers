<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'assembled'
    ];

    /**
     * Creator of project
     */
    public function owner()
    {
        return $this->hasOne(User::class , 'id' ,'user_id');
    }

    /**
     * Project Applications
     */

     public function applications(){
         return $this->hasMany(ProjectApplication::class);
     }
}
