<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $fillable = ['name'];
    
    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
