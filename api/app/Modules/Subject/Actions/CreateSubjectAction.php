<?php

namespace App\Modules\Subject\Actions;

use App\Action;
use App\Modules\Subject\Repositories\SubjectRepository;
use Illuminate\Http\Request;

class CreateSubjectAction extends Action
{
    public function rules()
    {
        return [
            'name' => 'required|unique:subjects,name',
        ];
    }

    public function handle(
        SubjectRepository $subjectRepository,
        Request $request
    ) {
        $subject = $subjectRepository->create($request->all());

        return response()->json($subject, 201);
    }
}
