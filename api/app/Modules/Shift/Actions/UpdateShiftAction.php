<?php

namespace App\Modules\Shift\Actions;

use App\Action;
use App\Modules\Shift\Repositories\ShiftRepository;
use Illuminate\Http\Request;

class UpdateShiftAction extends Action
{
    public function rules(int $id)
    {
        return [
            'name' => 'unique:shifts,name,'.$id,
        ];
    }

    public function handle(int $id, ShiftRepository $shiftRepository, Request $request)
    {
        $shift = $shiftRepository->update($request->all(), $id);

        return response()->json($shift, 200);
    }
}
