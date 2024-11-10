<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InterfaceController;

Route::get('/', [InterfaceController::Class, 'home']);

Route::get('/calculadora/{cropType}', [InterfaceController::class, 'index'])->name('calculadora');
Route::post('/secoes/{cropType}', [InterfaceController::class, 'getInputs'])->name('get.inputs');

Route::post('/calcular', [InterfaceController::class, 'calcular'])->name('calcular');

Route::get('/export/csv', [InterfaceController::class, 'exportCsv'])->name('export.csv');
Route::get('/export/pdf', [InterfaceController::class, 'exportPdf'])->name('export.pdf');

Route::fallback(function(){
    return view('errors.404');
 });
