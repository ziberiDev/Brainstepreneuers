<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccademyProject extends Model
{
    use HasFactory;

    /**
     * Accademy of the project
     */
    public function accademy() {
        return $this->belongsTo(Accademy::class);
    }
}
