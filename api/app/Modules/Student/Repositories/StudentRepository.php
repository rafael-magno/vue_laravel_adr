<?php

namespace App\Modules\Student\Repositories;

use App\Modules\Student\Models\Student;
use App\Repository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StudentRepository extends Repository
{
    public function __construct(Student $student)
    {
        $this->model = $student;
    }

    public function create(array $data): Model
    {
        DB::beginTransaction();

        $student = parent::create($data);
        $this->syncRelationships($student, $data);

        DB::commit();

        return $student;
    }

    public function update(array $data, $id): Model
    {
        DB::beginTransaction();

        $student = parent::update($data, $id);
        $this->syncRelationships($student, $data);

        DB::commit();

        return $student;
    }

    public function syncRelationships(Student $student, array $data)
    {
        $student->subjects()->sync($data['subjects_id'] ?? []);
        $student->load('shift', 'subjects');
    }
}
