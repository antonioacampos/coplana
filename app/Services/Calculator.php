<?php

namespace App\Services;

class Calculator
{ 
    public static function listInputs()
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

    public static function loadJsonData($jsonName)
    {
        $filePath = storage_path("app/inputs/{$jsonName}.json");

        if (!file_exists($filePath)) {
            return null;
        }

        return json_decode(file_get_contents($filePath), true);
    }

    public static function getSectionLabels($jsonName)
    {
        $allSections = Calculator::loadJsonData($jsonName);

        if (!$allSections) {
            return back()->withErrors('Arquivo de dados não encontrado');
        }
    
        $sectionLabels = [];
        foreach ($allSections as $sectionKey => $sectionData) {
            $sectionLabels[$sectionKey] = $sectionData['label'] ?? ucfirst($sectionKey);
        }

        return $sectionLabels;
    }

    public static function removeDuplicateInputs($inputs)
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

    public static function getInputs($selectedSections, $cropType)
    {
        $allSections = SELF::loadJsonData($cropType);

        $inputsDTO = [];

        if (!$allSections) {
            return back()->withErrors('Arquivo de dados não encontrado');
        }

        $sectionLabels = [];
        foreach ($allSections as $sectionKey => $sectionData) {
            $sectionLabels[$sectionKey] = $sectionData['label'] ?? ucfirst($sectionKey);
        }

        $inputsDTO['sectionLabels'] = $sectionLabels;

        $inputs = [];

        foreach ($selectedSections as $section) {
            if (isset($allSections[$section]['content'])) {
                $inputs = array_merge($inputs, $allSections[$section]['content']);
            }
        }

        $inputsDTO['inputs'] = Calculator::removeDuplicateInputs($inputs);

        return $inputsDTO;
    }

    public static function calculate($cropType, $selectedSections, $inputs)
    {
        
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

        $calcDTO['selectedSections'] = $selectedSections;
        $calcDTO['finalResults'] = $finalResults;
        $calcDTO['totalSum'] = $totalSum;
        $calcDTO['sectionLabels'] = $sectionLabels;

        return $calcDTO;
    }

    public static function generateCsvContent($selectedSections, $finalResults, $cropType)
    {
        $content = fopen('php://temp', 'w');

        fputcsv($content, ['Cultura:', strtoupper($cropType)]);
        fputcsv($content, ['Custo Total por ha']);
        fputcsv($content, []);
        fputcsv($content, ['Atividade Agrícola', 'Operações', 'Campo', 'Valor Final']);

        foreach ($selectedSections as $section) {
            if (isset($finalResults[$section])) {
                fputcsv($content, [strtoupper(ucfirst($section)), '', '', '']);

                foreach ($finalResults[$section] as $subsection => $values) {
                    fputcsv($content, ['', ucfirst(str_replace('_', ' ', $subsection)), '', '']);

                    foreach ($values as $inputName => $inputValue) {
                        fputcsv($content, [
                            '', '', ucfirst(str_replace('_', ' ', $inputName)),
                            is_numeric($inputValue) ? number_format($inputValue, 2, ',', '.') : $inputValue
                        ]);
                    }
                }
                fputcsv($content, []);
            }
        }

        rewind($content);
        return $content;
    }

    public static function preparePdfData($cropType)
    {
        $multiplicadoresPath = storage_path("app/multiplicadores/{$cropType}.json");

        if (!file_exists($multiplicadoresPath)) {
            return ['error' => 'Arquivo de multiplicadores não encontrado.'];
        }

        $multiplicadores = json_decode(file_get_contents($multiplicadoresPath), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return ['error' => 'Erro ao decodificar o arquivo JSON de multiplicadores.'];
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

        return ['sectionLabels' => $sectionLabels];
    }
}
