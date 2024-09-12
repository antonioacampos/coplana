<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NovaCalculadoraController extends Controller
{
    public function home(){
        return view('welcome');
    }
    public function index()
    {
        return view('calculadora');
    }

    public function calcular(Request $request)
    {
        // Validação flexível, valida apenas os campos presentes
        $validatedData = $request->validate([
            'inputs.*.number1' => 'nullable|numeric',
            'inputs.*.number2' => 'nullable|numeric',
            'inputs.*.number3' => 'nullable|numeric',
            'inputs.*.number4' => 'nullable|numeric',
            'inputs.*.number5' => 'nullable|numeric',
            'inputs.*.number6' => 'nullable|numeric',
            'inputs.*.number7' => 'nullable|numeric',
        ]);

        // Array para armazenar os resultados de cada view
        $results = [];
        $overallTotal = 0;

        // Iterando sobre cada conjunto de inputs
        foreach ($request->input('inputs') as $input) {
            $individualResults = [];

            // Multiplicando e somando os campos que estão presentes
            if (isset($input['number1'])) {
                $individualResults['result1'] = $input['number1'] * 2.2;
            }
            if (isset($input['number2'])) {
                $individualResults['result2'] = $input['number2'] * 4.4;
            }
            if (isset($input['number3'])) {
                $individualResults['result3'] = $input['number3'] * 6.6;
            }
            if (isset($input['number4'])) {
                $individualResults['result4'] = $input['number4'] * 2.2;
            }
            if (isset($input['number5'])) {
                $individualResults['result5'] = $input['number5'] * 4.4;
            }
            if (isset($input['number6'])) {
                $individualResults['result6'] = $input['number6'] * 6.6;
            }
            if (isset($input['number7'])) {
                $individualResults['result7'] = $input['number7'] * 6.6;
            }

            // Calculando o total de cada view
            $total = array_sum($individualResults);

            // Salvando os resultados individuais e o total
            $results[] = [$total, $individualResults];

            // Somando ao total geral
            $overallTotal += $total;
        }

        return view('calculadora', [
            'results' => $results,
            'overallTotal' => $overallTotal,
        ]);
    }
}
