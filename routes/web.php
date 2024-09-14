<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculadoraController;
use App\Http\Controllers\InputController;

Route::get('/calculadora', [CalculadoraController::class, 'index']);
Route::post('/calcular', [CalculadoraController::class, 'calcular'])->name('calcular');
Route::get('/', [CalculadoraController::Class, 'home']);

Route::post('/get-inputs', [InputController::class, 'getInputs'])->name('get-inputs');



// Permite usar Gate::check('user')na view 404
Route::fallback(function(){
    return view('errors.404');
 });
