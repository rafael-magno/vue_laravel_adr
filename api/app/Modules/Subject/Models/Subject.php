<?php

namespace App\Modules\Subject\Models;

use App\Modules\Student\Models\Student;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name'];

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
}
