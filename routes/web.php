<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// routes/web.php
Route::get('print/data', [App\Http\Controllers\PrintController::class, 'printData'])->name('print.data');
Route::get('download/pdf', [App\Http\Controllers\PrintController::class, 'downloadPdf'])->name('download.pdf');
