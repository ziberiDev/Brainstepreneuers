<?php

namespace App\Models;

use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectApplication extends Model
{
    use HasFactory;

    public function project() {
        return $this->belongsTo(Project::class)->with('owner');
    }
}
