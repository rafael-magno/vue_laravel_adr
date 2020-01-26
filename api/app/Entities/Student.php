<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }
    
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
}
