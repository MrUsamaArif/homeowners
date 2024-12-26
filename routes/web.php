<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NameProcessorController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/upload-csv', [NameProcessorController::class, 'uploadCsv']);
