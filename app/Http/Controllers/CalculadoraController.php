<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Preparo;

class CalculadoraController extends Controller
{
    public function home(){
        return view('welcome');
    }
    public function index()
    {
        // dd(Preparo::list());
        return view('calculadora');
    }

    public function calcular(Request $request)
    {
        // Verifique se os dados estão sendo recebidos
        if (!$request->has('sections') || !$request->has('inputs')) {
            return response()->json([
                'error' => 'Dados inválidos',
            ], 400);
        }

        $selectedSections = $request->input('sections');  // Seções selecionadas
        $inputs = $request->input('inputs');              // Valores dos inputs

        // Iniciar resultados finais
        $finalResults = [];

        // Processar os dados e multiplicar por 2.2
        foreach ($inputs as $inputName => $inputValue) {
            if (is_numeric($inputValue)) {
                $finalResults[$inputName] = $inputValue * 2.2;
            } else {
                $finalResults[$inputName] = "Valor inválido";
            }
        }

        $teste = response()->json([
            'message' => 'Cálculo realizado com sucesso',
            'selectedSections' => $selectedSections,
            'finalResults' => $finalResults
        ]); 
        // Retorna a view com os dados
        return view('resultado', [
            'selectedSections' => $selectedSections,
            'finalResults' => $finalResults
        ]);
    }
}
