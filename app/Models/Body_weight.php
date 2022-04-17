<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Body_weight extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'weight'
    ];
    // Relationships
    public function user() {
        return $this->hasOne(User::class);
    }
}
