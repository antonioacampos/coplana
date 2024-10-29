<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculadoraController;
use App\Http\Controllers\InputController;

Route::get('/calculadora-amendoim', [CalculadoraController::class, 'indexAmendoim']);
Route::get('/calculadora-soja', [CalculadoraController::class, 'indexSoja']);
Route::get('/calculadora-cana-planta', [CalculadoraController::class, 'indexCanaPlanta']);
Route::get('/calculadora-cana-soca', [CalculadoraController::class, 'indexCanaSoca']);

Route::post('/calcular', [CalculadoraController::class, 'calcular'])->name('calcular');
Route::get('/', [CalculadoraController::Class, 'home']);

Route::get('/export/csv', [CalculadoraController::class, 'exportCsv'])->name('export.csv');
Route::get('/export/pdf', [CalculadoraController::class, 'exportPdf'])->name('export.pdf');

Route::post('/get-inputs-amendoim', [InputController::class, 'getInputsAmendoim'])->name('get-inputs-amendoim');
Route::post('/get-inputs-soja', [InputController::class, 'getInputsSoja'])->name('get-inputs-soja');

// Permite usar Gate::check('user')na view 404
Route::fallback(function(){
    return view('errors.404');
 });
