<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress_weight extends Model
{
    use HasFactory;
    protected $fillable = [
        'weight',
        'reps',
        'sets',
    ];

    public function user() {
        return $this->hasOne(User::class);
    }
    public function training_exercise() {
        return $this->hasOne(Training_exercise::class);
    }
}
