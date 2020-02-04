<?php

namespace App\Modules\Student\Models;

use App\Modules\Shift\Models\Shift;
use App\Modules\Subject\Models\Subject;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'shift_id'];
    protected $with = ['shift', 'subjects'];

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
}
