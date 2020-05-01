<?php

namespace App\Modules\Shift\Actions;

use App\Action;
use App\Modules\Shift\Repositories\ShiftRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateShiftAction extends Action
{
    public function rules(): array
    {
        return [
            'name' => 'required|unique:shifts,name',
        ];
    }

    public function handle(
        ShiftRepository $shiftRepository,
        Request $request
    ): JsonResponse {
        $data = $request->all();
        $shift = $shiftRepository->create($data);

        return response()->json($shift, 201);
    }
}
