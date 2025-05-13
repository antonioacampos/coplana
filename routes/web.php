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

// JSON Management Routes
Route::prefix('json')->group(function () {
    Route::get('/', [InterfaceController::class, 'jsonIndex'])->name('json.index');
    Route::get('/create', [InterfaceController::class, 'create'])->name('json.create');
    Route::post('/store', [InterfaceController::class, 'store'])->name('json.store');
    Route::get('/{folder}/{filename}/edit', [InterfaceController::class, 'edit'])->name('json.edit');
    Route::put('/{folder}/{filename}', [InterfaceController::class, 'update'])->name('json.update');
    Route::delete('/{folder}/{filename}', [InterfaceController::class, 'destroy'])->name('json.destroy');
});

Route::fallback(function () {
    return view('errors.404');
});
