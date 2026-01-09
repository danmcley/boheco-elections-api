<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});


// Route::get('/test-db', function () {
//     return DB::select("SELECT name FROM sys.tables");
// });
require __DIR__.'/auth.php';
