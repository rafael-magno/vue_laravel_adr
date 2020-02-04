<?php

namespace App\Modules\Shift\Actions;

use App\Action;
use App\Modules\Shift\Repositories\ShiftRepository;
use Illuminate\Http\Request;

class CreateShiftAction extends Action
{
    public function rules()
    {
        return [
            'name' => 'required|unique:shifts,name',
        ];
    }

    public function handle(
        ShiftRepository $shiftRepository,
        Request $request
    ) {
        $shift = $shiftRepository->create($request->all());

        return response()->json($shift, 201);
    }
}
