<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
}
