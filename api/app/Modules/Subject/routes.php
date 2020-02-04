<?php

use App\Modules\Subject\Actions\CreateSubjectAction;
use App\Modules\Subject\Actions\DeleteSubjectAction;
use App\Modules\Subject\Actions\GetSubjectAction;
use App\Modules\Subject\Actions\ListSubjectsAction;
use App\Modules\Subject\Actions\UpdateSubjectAction;
use Illuminate\Support\Facades\Route;

Route::post('/subjects', CreateSubjectAction::class);
Route::get('/subjects', ListSubjectsAction::class);
Route::get('/subjects/{id}', GetSubjectAction::class);
Route::put('/subjects/{id}', UpdateSubjectAction::class);
Route::delete('/subjects/{id}', DeleteSubjectAction::class);
