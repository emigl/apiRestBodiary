<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training_exercise extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'muscle'
    ];


    public function progress_weight() {
        return $this->hasMany(Progress_weight::class);
    }
}

