<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'accademy_id',
        'biography',
        'image',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // eloquent realtions

    /**
     * User skills
     */
    public function skills()
    {
        return $this->hasMany(UserSkill::class);
    }

    /**
     * User Created Projects
     */

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /**
     * User Applications on projects
     */

    public function applications()
    {
        return $this->hasMany(ProjectApplication::class);
    }
    /**
     * User Applications on projects
     */

    public function accademy()
    {
        return $this->belongsTo(Accademy::class);
    }
}
