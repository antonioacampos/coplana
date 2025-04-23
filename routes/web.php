<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InterfaceController;

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/coplana', [InterfaceController::class, 'home'])->name('home');

Route::get('coplana/calculadora/{cropType}', [InterfaceController::class, 'index'])->name('calculadora');
Route::post('coplana/secoes/{cropType}', [InterfaceController::class, 'getInputs'])->name('get.inputs');

Route::post('coplana/calcular', [InterfaceController::class, 'calcular'])->name('calcular');

Route::get('coplana/export/csv', [InterfaceController::class, 'exportCsv'])->name('export.csv');
Route::get('coplana/export/pdf', [InterfaceController::class, 'exportPdf'])->name('export.pdf');

Route::get('coplana/create', [InterfaceController::class, 'create'])->name('json.create');
Route::post('coplana/create', [InterfaceController::class, 'store'])->name('json.store');

Route::get('coplana/list', [InterfaceController::class, 'index'])->name('json.list');



Route::fallback(function () {
    return view('errors.404');
});
