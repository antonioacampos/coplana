<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculadoraController;
use App\Http\Controllers\NovaCalculadoraController;

Route::get('/calculadora', [CalculadoraController::class, 'index']);
Route::post('/calculadora', [CalculadoraController::class, 'calcular'])->name('calcular');
Route::get('/', [CalculadoraController::Class, 'home']);




// Permite usar Gate::check('user')na view 404
Route::fallback(function(){
    return view('errors.404');
 });
