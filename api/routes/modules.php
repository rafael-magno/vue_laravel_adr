<?php

use Illuminate\Support\Facades\Route;

Route::group([], base_path('app/Modules/Auth/routes.php'));
Route::group([/*'middleware' => ['auth.jwt']*/], function() {
    Route::group([], base_path('app/Modules/Shift/routes.php'));
    Route::group([], base_path('app/Modules/Student/routes.php'));
    Route::group([], base_path('app/Modules/Subject/routes.php'));
});
