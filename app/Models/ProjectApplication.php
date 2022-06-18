<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProjectApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'project_id',
        'message',
        'accepted'
    ];


    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class)->with('owner');
    }

    public function applicant(): HasOne
    {
        return $this->hasOne(User::class , "id" , "user_id");
    }
}
