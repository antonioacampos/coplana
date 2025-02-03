<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Services\Calculator;

class InterfaceController extends Controller
{

    public function home()
    {
        $cropTypes = Calculator::listInputs();
        return view('welcome', compact('cropTypes'));
    }

    public function index($cropType)
    {
        $inputs = [];
        $sectionLabels = Calculator::getSectionLabels($cropType);

        return view('inputPage', compact('inputs', 'cropType', 'sectionLabels'));
    }

    // public function getInputs(Request $request, $cropType)
    // {
    //     $selectedSections = $request->input('sections', []);
    //     $inputsDTO = Calculator::getInputs($selectedSections, $cropType);

    //     $sectionLabels = $inputsDTO['sectionLabels'];
    //     $inputs = $inputsDTO['inputs'];

    //     $equipmentModels = [];
    //     foreach ($inputs as $input) {
    //         if (in_array($input['name'], ["depreciacao_tratores", "depreciacao_caminhoes", "depreciacao_plantadeira",
    //         "depreciacao_grades_aradoras", "depreciacao_adubadoras", "depreciacao_pulverizador",
    //         "depreciacao_distribuidora_fertilizantes", "depreciacao_distribuidora_corretivos", 
    //         "depreciacao_distribuidor_calcario", "depreciacao_colhedora"])) {
    //             $equipmentModels[$input['name']] = Calculator::loadEquipmentModels($input['name']);
    //         }
    //     }
    //     dd($equipmentModels);
    //     return view('inputPage', compact('inputs', 'selectedSections', 'cropType', 'sectionLabels', 'equipmentModels'));
    // }

    public function getInputs(Request $request, $cropType)
    {
        $selectedSections = $request->input('sections', []);
        $inputsDTO = Calculator::getInputs($selectedSections, $cropType);

        $sectionLabels = $inputsDTO['sectionLabels'];
        $inputs = $inputsDTO['inputs'];
    
        // Carregar todos os equipamentos do JSON correspondente ao cropType
        $allEquipmentModels = Calculator::loadEquipmentModels($cropType);
        // dd($allEquipmentModels);
        // Filtrar os modelos de equipamentos relevantes para os inputs
        $equipmentModels = [];
        foreach ($inputs as $input) {
            if(isset($allEquipmentModels)){
            foreach ($allEquipmentModels['equipamentos'] as $equipmentKey => $equipmentData) {
                if (isset($equipmentData['sections']) && in_array($input['name'], $equipmentData['sections'])) {
                    $equipmentModels[$input['name']] = $equipmentData['conteudo'];
                }
            }
        }
        }
        // dd($equipmentModels);
        // dd($equipmentModels);
        return view('inputPage', compact('inputs', 'selectedSections', 'cropType', 'sectionLabels', 'equipmentModels'));
    }
    


    public function calcular(Request $request)
    {
        if (!$request->has('sections') || !$request->has('inputs')) {
            return response()->json(['error' => 'Dados inválidos'], 400);
        }

        $cropType = $request->input('cropType');
        $selectedSections = $request->input('sections');
        $inputs = $request->input('inputs');

        $calcDTO = Calculator::calculate($cropType, $selectedSections, $inputs);

        $selectedSections = $calcDTO['selectedSections'];
        $finalResults = $calcDTO['finalResults'];
        $totalSum = $calcDTO['totalSum'];
        $sectionLabels = $calcDTO['sectionLabels'];
        $sectionTotals = $calcDTO['sectionTotals'];
        $subsectionTotals = $calcDTO['subsectionTotals'];
        
        return view('displayResults', [
            'cropType' => $cropType,
            'selectedSections' => $selectedSections,
            'finalResults' => $finalResults,
            'totalSum' => $totalSum,
            'sectionLabels' => $sectionLabels,
            'sectionTotals' => $sectionTotals,
            'subsectionTotals' => $subsectionTotals
        ]);
    }

   public function exportCsv(Request $request)
    {
        $selectedSections = $request->input('sections');
        $finalResults = $request->input('results');
        $cropType = $request->input('cropType');

        $csvContent = Calculator::generateCsvContent($selectedSections, $finalResults, $cropType);

        $response = new StreamedResponse(function () use ($csvContent) {
            fpassthru($csvContent);
            fclose($csvContent);
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

        $pdfData = Calculator::preparePdfData($cropType);

        if (isset($pdfData['error'])) {
            return back()->withErrors($pdfData['error']);
        }

        $pdf = PDF::loadView('exportResults', [
            'selectedSections' => $selectedSections,
            'finalResults' => $finalResults,
            'sectionLabels' => $pdfData['sectionLabels']
        ]);

        return $pdf->download('resultados.pdf');
    }   
    
}
