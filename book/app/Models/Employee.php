<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }
}
