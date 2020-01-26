<?php

use App\Modules\Shift\Actions\CreateShiftAction;
use App\Modules\Shift\Actions\DeleteShiftAction;
use App\Modules\Shift\Actions\ListShiftsAction;
use App\Modules\Shift\Actions\GetShiftAction;
use App\Modules\Shift\Actions\UpdateShiftAction;
use Illuminate\Support\Facades\Route;

Route::post('/shifts',  CreateShiftAction::class);
Route::get('/shifts', ListShiftsAction::class);
Route::get('/shifts/{id}', GetShiftAction::class);
Route::put('/shifts/{id}', UpdateShiftAction::class);
Route::delete('/shifts/{id}', DeleteShiftAction::class);
