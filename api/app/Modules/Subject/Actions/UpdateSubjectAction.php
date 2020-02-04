<?php

namespace App\Modules\Subject\Actions;

use App\Action;
use App\Modules\Subject\Repositories\SubjectRepository;
use Illuminate\Http\Request;

class UpdateSubjectAction extends Action
{
    public function rules(int $id)
    {
        return [
            'name' => 'unique:subjects,name,'.$id,
        ];
    }

    public function handle(int $id, SubjectRepository $subjectRepository, Request $request)
    {
        $subject = $subjectRepository->update($request->all(), $id);

        return response()->json($subject, 200);
    }
}
