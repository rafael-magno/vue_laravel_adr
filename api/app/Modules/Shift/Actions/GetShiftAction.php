<?php

namespace App\Modules\Shift\Actions;

use App\Action;
use App\Exceptions\HttpResponseException;
use App\Modules\Shift\Repositories\ShiftRepository;
use Illuminate\Http\JsonResponse;

class GetShiftAction extends Action
{
    public function handle(int $id, ShiftRepository $shiftRepository): JsonResponse
    {
        $shift = $shiftRepository->find($id);

        if (!$shift) {
            throw new HttpResponseException('Not found.', 404);
        }

        return response()->json($shift, 200);
    }
}
