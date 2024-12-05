<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InterfaceController;

Route::get('/coplana', [InterfaceController::Class, 'home']);

Route::get('coplana/calculadora/{cropType}', [InterfaceController::class, 'index'])->name('calculadora');
Route::post('coplana/secoes/{cropType}', [InterfaceController::class, 'getInputs'])->name('get.inputs');

Route::post('coplana/calcular', [InterfaceController::class, 'calcular'])->name('calcular');

Route::get('coplana/export/csv', [InterfaceController::class, 'exportCsv'])->name('export.csv');
Route::get('coplana/export/pdf', [InterfaceController::class, 'exportPdf'])->name('export.pdf');

Route::fallback(function(){
    return view('errors.404');
 });
