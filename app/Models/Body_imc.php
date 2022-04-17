<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Body_imc extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'imc'
    ];
    
    //Relationships
    
    public function user() {
        return $this->hasOne(User::class);
    }
}
