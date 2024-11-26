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

        return array_map(function ($file) {
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

    public static function getInputs($selectedSections, $jsonName)
    {
        $allSections = SELF::loadJsonData($jsonName);

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

    public static function calculate($jsonName, $selectedSections, $inputs)
    {
        $multiplicadoresPath = storage_path("app/multiplicadores/{$jsonName}.json");

        if (!file_exists($multiplicadoresPath)) {
            return response()->json(['error' => 'Arquivo de multiplicadores não encontrado'], 404);
        }

        $multiplicadores = json_decode(file_get_contents($multiplicadoresPath), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['error' => 'Erro ao decodificar o arquivo JSON de multiplicadores'], 500);
        }

        $finalResults = [];
        $sectionTotals = [];
        $subsectionTotals = [];
        $totalSum = 0;

        foreach ($inputs as $inputName => $inputValue) {
            if (is_numeric($inputValue)) {
                foreach ($selectedSections as $section) {
                    if (isset($multiplicadores[$section]['content'])) {
                        foreach ($multiplicadores[$section]['content'] as $subsection => $subsectionData) {
                            if (isset($subsectionData['multiplicadores'][$inputName])) {
                                $resultado = $inputValue * $subsectionData['multiplicadores'][$inputName];

                                $finalResults[$section][$subsection][$inputName] = $resultado;

                                if (!isset($subsectionTotals[$section][$subsection])) {
                                    $subsectionTotals[$section][$subsection] = 0;
                                }
                                $subsectionTotals[$section][$subsection] += $resultado;

                                if (!isset($sectionTotals[$section])) {
                                    $sectionTotals[$section] = 0;
                                }
                                $sectionTotals[$section] += $resultado;

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

        $calcDTO = [
            'selectedSections' => $selectedSections,
            'finalResults' => $finalResults,
            'sectionTotals' => $sectionTotals,
            'subsectionTotals' => $subsectionTotals,
            'totalSum' => $totalSum,
            'sectionLabels' => $sectionLabels,
        ];

        return $calcDTO;
    }


    public static function generateCsvContent($selectedSections, $finalResults, $jsonName)
    {
        $content = fopen('php://temp', 'w');

        fputcsv($content, ['Tipo: ', strtoupper($jsonName)]);
        fputcsv($content, ['Custo total por área']);
        fputcsv($content, []);
        fputcsv($content, ['Atividade', 'Operações', 'Campo', 'Valor Final']);

        foreach ($selectedSections as $section) {
            if (isset($finalResults[$section])) {
                fputcsv($content, [strtoupper(ucfirst($section)), '', '', '']);

                foreach ($finalResults[$section] as $subsection => $values) {
                    fputcsv($content, ['', ucfirst(str_replace('_', ' ', $subsection)), '', '']);

                    foreach ($values as $inputName => $inputValue) {
                        fputcsv($content, [
                            '',
                            '',
                            ucfirst(str_replace('_', ' ', $inputName)),
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

    public static function preparePdfData($jsonName)
    {
        $multiplicadoresPath = storage_path("app/multiplicadores/{$jsonName}.json");

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
