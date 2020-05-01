<?php

namespace App\Modules\Shift\Actions;

use App\Action;
use App\Exceptions\HttpResponseException;
use App\Exceptions\ItemNotFoundException;
use App\Modules\Shift\Repositories\ShiftRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateShiftAction extends Action
{
    public function rules(int $id): array
    {
        return [
            'name' => 'unique:shifts,name,'.$id,
        ];
    }

    public function handle(
        int $id,
        ShiftRepository $shiftRepository,
        Request $request
    ): JsonResponse {
        $data = $request->all();

        try {
            $shift = $shiftRepository->update($data, $id);
        } catch (ItemNotFoundException $exception) {
            throw new HttpResponseException('Not found.', 404);
        }

        return response()->json($shift, 200);
    }
}
