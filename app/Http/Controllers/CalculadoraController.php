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

        // Defina os fatores multiplicadores para cada item em cada seção
        $multiplicadores = [
            'preparo' => [
                'gradagem_pesada' => 1.0,
                'aracao_iveca' => 1.0,
                'gradagem_intermediaria' => 1.0,
                'gradagem_niveladora' => 1.0,
                'canteirizacao' => 1.0,
                'subsolagem' => 1.0,
                'pulverizacao_dessecacao' => 1.0,
                'calcario' => 2.5,
                'fertilizante_fosfatado' => 0.25,
                'fertilizante_potassico' => 0.20,
                'fertilizante_nitrogenado' => 0.13,
                'micronutrientes' => 0.02,
                'depreciacao_tratores' => 0.00167,
                'depreciacao_grades_aradoras' => 0.001169,
                'depreciacao_adubadoras' => 0.001169,
                'depreciacao_caminhoes' => 0.00167,
                'combustivel' => 20.0,
                'manutencao_preventiva' => 1.0,
                'manutencao_corretiva' => 1.0,
                'operadores_tratores' => 8.0,
                'trabalhadores_agricolas' => 6.0,
                'tecnico_agricola' => 2.0,
                'tecnico_mecanizacao' => 1.0,
                'supervisor_campo' => 2.0,
                'supervisor_admin' => 1.0,
                'motoristas_caminhao' => 2.0,
            ],
            'aplicacao' => [
                'calcario' => 2.5,
                'gesso_agricola' => 1.5,
                'combustivel' => 13.0,
                'depreciacao_tratores' => 0.00055,
                'depreciacao_grades_aradoras' => 0.000385,
                'depreciacao_distribuidor_calcario' => 0.000495,
                'depreciacao_caminhoes' => 0.00055,
                'manutencao_preventiva' => 1.0,
                'manutencao_corretiva' => 1.0,
                'tecnico_agricola' => 2.0,
                'operador_trator' => 2.0,
                'auxiliares_operacao' => 4.0,
                'motorista_caminhao' => 1.0,
                'mao_de_obra_aplicacao' => 12.0,
            ],
            'plantio' => [
                'sementes_amendoim' => 0.1,
                'fertilizante_nitrogenio' => 0.075,
                'fertilizante_fosforo' => 0.25,
                'fertilizante_potassio' => 0.20,
                'agua' => 700.0,
                'combustivel' => 18.0,
                'manutencao_preventiva' => 1.0,
                'manutencao_corretiva' => 1.0,
                'depreciacao_tratores' => 0.00055,
                'depreciacao_plantadeira' => 0.000385,
                'depreciacao_caminhoes' => 0.00055,
                'tecnico_agricola' => 2.0,
                'operador_trator' => 4.0,
                'auxiliares_operacao' => 8.0,
                'motorista_caminhao' => 1.0,
            ],
            'manejo' => [
                'pulverizacao_autopropelido' => 1.0,
                'pulverizacao_arrasto' => 1.0,
                'fertilizante_nitrogenio_pos' => 50.0,
                'fertilizante_fosforo_pos' => 25.0,
                'fertilizante_potassio_pos' => 40.0,
                'micronutrientes_pos' => 1.5,
                'inseticidas' => 1.0,
                'fungicidas' => 1.0,
                'herbicidas' => 1.0,
                'combustivel' => 16.0,
                'manutencao_preventiva' => 1.0,
                'manutencao_corretiva' => 1.0,
                'depreciacao_tratores' => 0.00055,
                'depreciacao_pulverizador' => 0.000825,
                'depreciacao_distribuidora_fertilizantes' => 0.00055,
                'depreciacao_distribuidora_corretivos' => 0.00055,
                'depreciacao_caminhoes' => 0.00055,
                'tecnico_agricola' => 4.0,
                'operador_trator' => 4.0,
                'auxiliares_operacao' => 8.0,
                'motorista_caminhao' => 2.0,
                'mao_de_obra_aplicacao' => 24.0,
            ],
            'colheita' => [
                'combustivel' => 20.0,
                'manutencao_preventiva' => 1.0,
                'manutencao_corretiva' => 1.0,
                'depreciacao_caminhoes' => 0.00139,
                'depreciacao_colhedora' => 0.00138,
                'operador_colhedora' => 6.0,
                'auxiliares_colhedora' => 12.0,
                'tecnico_agricola' => 2.0,
                'manuseador_carregador' => 24.0,
                'motoristas_caminhao' => 2.0,
            ]
        ];        
        // Iniciar resultados finais
        $finalResults = [];

        // Processar os dados
        foreach ($inputs as $inputName => $inputValue) {
            if (is_numeric($inputValue)) {
                $inputResult = 0;
                
                // Verificar as seções selecionadas e aplicar os multiplicadores
                foreach ($selectedSections as $section) {
                    if (isset($multiplicadores[$section]) && isset($multiplicadores[$section][$inputName])) {
                        // Multiplica o input pelo multiplicador da seção
                        $inputResult += $inputValue * $multiplicadores[$section][$inputName];
                    }
                }

                // Armazenar o resultado final para o input
                $finalResults[$inputName] = $inputResult;
            } else {
                $finalResults[$inputName] = "Valor inválido";
            }
        }

        // Retorna a view com os dados
        return view('resultado', [
            'selectedSections' => $selectedSections,
            'finalResults' => $finalResults
        ]);
    }
}
