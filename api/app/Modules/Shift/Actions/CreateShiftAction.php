<?php

namespace App\Modules\Shift\Actions;

use App\Entities\Shift;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Action;

class CreateShiftAction extends Action
{
    public function handle(Request $request)
    {
        return response()->json(Shift::create($request->all()), 201);
    }
}