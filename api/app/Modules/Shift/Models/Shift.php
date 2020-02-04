<?php

namespace App\Modules\Shift\Models;

use App\Modules\Student\Models\Student;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $fillable = ['name'];

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
