<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculadoraController extends Controller
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
        $validatedData = $request->validate([
            'number1' => 'required|numeric',
            'number2' => 'required|numeric',
            'number3' => 'required|numeric',
            'number4' => 'required|numeric',
            'number5' => 'required|numeric',
            'number6' => 'required|numeric',
            'number7' => 'required|numeric',
        ]);

        $number1 = $request->input('number1');
        $number2 = $request->input('number2');
        $number3 = $request->input('number3');
        $number4 = $request->input('number4');
        $number5 = $request->input('number5');
        $number6 = $request->input('number6');
        $number7 = $request->input('number7');

        // Fazendo as multiplicações
        $result1 = $number1 * 2.2;
        $result2 = $number2 * 4.4;
        $result3 = $number3 * 6.6;
        $result4 = $number4 * 2.2;
        $result5 = $number5 * 4.4;
        $result6 = $number6 * 6.6;
        $result7 = $number7 * 6.6;

        $total = $result1 + $result2 + $result3 + $result4 + $result5 + $result6 + $result7;

        return view('calculadora', [
            'result1' => $result1,
            'result2' => $result2,
            'result3' => $result3,
            'result4' => $result4,
            'result5' => $result5,
            'result6' => $result6,
            'result7' => $result7,
            // 'number1' => $number1,
            // 'number2' => $number2,
            // 'number3' => $number3,
            // 'number4' => $number4,
            // 'number5' => $number5,
            // 'number6' => $number6,
            // 'number7' => $number7,
            'total' => $total
        ]);
    }
}
