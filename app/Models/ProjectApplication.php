<?php

namespace App\Models;

use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'project_id',
        'message',
        'accepted'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class)->with('owner');
    }

    public function applicant() {
        return $this->hasOne(User::class , "id" , "user_id");
    }
}
