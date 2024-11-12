<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use Symfony\Component\HttpFoundation\StreamedResponse;

class InterfaceController extends Controller
{
    public static function list()
    {
        if (!is_dir(storage_path("app/inputs"))) {
            mkdir(storage_path("app/inputs"), 0755);
        }

        $path = storage_path('app/inputs/*.json');
        $files = glob($path);

        return array_map(function($file) {
            return pathinfo($file, PATHINFO_FILENAME);
        }, $files);
    }

    public function home()
    {
        $cropTypes = SELF::list();
        return view('welcome', compact('cropTypes'));
    }

    public function index($cropType)
    {
        $inputs = [];

        $allSections = $this->loadJsonData($cropType);

        if (!$allSections) {
            return back()->withErrors('Arquivo de dados não encontrado');
        }
    
        $sectionLabels = [];
        foreach ($allSections as $sectionKey => $sectionData) {
            $sectionLabels[$sectionKey] = $sectionData['label'] ?? ucfirst($sectionKey);
        }

        return view('inputPage', compact('inputs', 'cropType', 'sectionLabels'));
    }

    protected function loadJsonData($cropType)
    {
        $filePath = storage_path("app/inputs/{$cropType}.json");

        if (!file_exists($filePath)) {
            return null;
        }

        return json_decode(file_get_contents($filePath), true);
    }

    public function getInputs(Request $request, $cropType)
    {
        $selectedSections = $request->input('sections', []);
        $allSections = $this->loadJsonData($cropType);

        if (!$allSections) {
            return back()->withErrors('Arquivo de dados não encontrado');
        }

        $sectionLabels = [];
        foreach ($allSections as $sectionKey => $sectionData) {
            $sectionLabels[$sectionKey] = $sectionData['label'] ?? ucfirst($sectionKey);
        }

        $inputs = [];

        foreach ($selectedSections as $section) {
            if (isset($allSections[$section]['content'])) {
                $inputs = array_merge($inputs, $allSections[$section]['content']);
            }
        }

        $inputs = $this->removeDuplicateInputs($inputs);
        return view('inputPage', compact('inputs', 'selectedSections', 'cropType', 'sectionLabels'));
    }

    protected function removeDuplicateInputs($inputs)
    {
        $uniqueInputs = [];
        $addedNames = [];

        foreach ($inputs as $input) {
            if (!in_array($input['name'], $addedNames)) {
                $uniqueInputs[] = $input;
                $addedNames[] = $input['name'];
            }
        }

        return $uniqueInputs;
    }

    public function calcular(Request $request)
    {
        if (!$request->has('sections') || !$request->has('inputs')) {
            return response()->json(['error' => 'Dados inválidos'], 400);
        }

        $cropType = $request->input('cropType');
        $selectedSections = $request->input('sections');
        $inputs = $request->input('inputs');

        $multiplicadoresPath = storage_path("app/multiplicadores/{$cropType}.json");

        if (!file_exists($multiplicadoresPath)) {
            return response()->json(['error' => 'Arquivo de multiplicadores não encontrado'], 404);
        }

        $multiplicadores = json_decode(file_get_contents($multiplicadoresPath), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['error' => 'Erro ao decodificar o arquivo JSON de multiplicadores'], 500);
        }

        $finalResults = [];
        $totalSum = 0;
        foreach ($inputs as $inputName => $inputValue) {
            if (is_numeric($inputValue)) {
                foreach ($selectedSections as $section) {
                    if (isset($multiplicadores[$section]['content'])) {
                        // Itera sobre cada subseção dentro de "content"
                        foreach ($multiplicadores[$section]['content'] as $subsection => $subsectionData) {
                            if (isset($subsectionData['multiplicadores'][$inputName])) {
                                // Acessa o multiplicador específico
                                $resultado = $inputValue * $subsectionData['multiplicadores'][$inputName];
                                $finalResults[$section][$subsection][$inputName] = $resultado;
                                $totalSum += $resultado;
                            }
                        }
                    }
                }
            } else {
                foreach ($selectedSections as $section) {
                    $finalResults[$section][$inputName] = "Valor inválido";
                }
            }
        }

        $sectionLabels = [];
        foreach ($multiplicadores as $sectionKey => $sectionData) {
            $sectionLabels[$sectionKey] = $sectionData['label'] ?? ucfirst($sectionKey);
            if (isset($sectionData['content'])) {
                foreach ($sectionData['content'] as $subsectionKey => $subsectionData) {
                    $sectionLabels[$sectionKey . '.' . $subsectionKey] = $subsectionData['label'] ?? ucfirst($subsectionKey);
                }
            }
        }
        
        // dd($cropType, $selectedSections,$finalResults,$totalSum);
        return view('displayResults', [
            'cropType' => $cropType,
            'selectedSections' => $selectedSections,
            'finalResults' => $finalResults,
            'totalSum' => $totalSum,
            'sectionLabels' => $sectionLabels
        ]);
    }

    public function exportCsv(Request $request)
    {
        $selectedSections = $request->input('sections');
        $finalResults = $request->input('results');
        $cropType = $request->input('cropType');

        $response = new StreamedResponse(function() use ($selectedSections, $finalResults, $cropType) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['Cultura:', strtoupper($cropType)]);
            fputcsv($handle, ['Custo Total por ha']);
            fputcsv($handle, []);

            fputcsv($handle, ['Atividade Agrícola', 'Operações', 'Campo', 'Valor Final']);

            foreach ($selectedSections as $section) {
                if (isset($finalResults[$section])) {
                    fputcsv($handle, [strtoupper(ucfirst($section)), '', '', '']);

                    foreach ($finalResults[$section] as $subsection => $values) {
                        fputcsv($handle, ['', ucfirst(str_replace('_', ' ', $subsection)), '', '']);

                        foreach ($values as $inputName => $inputValue) {
                            fputcsv($handle, [
                                '', '', ucfirst(str_replace('_', ' ', $inputName)),
                                is_numeric($inputValue) ? number_format($inputValue, 2, ',', '.') : $inputValue
                            ]);
                        }
                    }
                    fputcsv($handle, []);
                }
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="resultados.csv"');

        return $response;
    }

    public function exportPdf(Request $request)
    {
        $selectedSections = $request->input('sections');
        $finalResults = $request->input('results');
        $cropType = $request->input('cropType');
    
        $multiplicadoresPath = storage_path("app/multiplicadores/{$cropType}.json");
    
        if (!file_exists($multiplicadoresPath)) {
            return back()->withErrors('Arquivo de multiplicadores não encontrado.');
        }
    
        $multiplicadores = json_decode(file_get_contents($multiplicadoresPath), true);
    
        if (json_last_error() !== JSON_ERROR_NONE) {
            return back()->withErrors('Erro ao decodificar o arquivo JSON de multiplicadores.');
        }
    
        $sectionLabels = [];
        foreach ($multiplicadores as $sectionKey => $sectionData) {
            $sectionLabels[$sectionKey] = $sectionData['label'] ?? ucfirst($sectionKey);
            if (isset($sectionData['content'])) {
                foreach ($sectionData['content'] as $subsectionKey => $subsectionData) {
                    $sectionLabels[$sectionKey . '.' . $subsectionKey] = $subsectionData['label'] ?? ucfirst($subsectionKey);
                }
            }
        }
    
        $pdf = PDF::loadView('exportResults', [
            'selectedSections' => $selectedSections,
            'finalResults' => $finalResults,
            'sectionLabels' => $sectionLabels
        ]);
    
        return $pdf->download('resultados.pdf');
    }
    
}
