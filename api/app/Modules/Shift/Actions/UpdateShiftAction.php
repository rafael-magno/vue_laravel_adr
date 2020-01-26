<?php

namespace App\Modules\Shift\Actions;

use App\Entities\Shift;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Action;

class UpdateShiftAction extends Action
{
    public function handle(int $id, Request $request)
    {
        $shift = Shift::find($id);
        $shift->fill($request->all());
        return response()->json($shift->save(), 200);
    }
}