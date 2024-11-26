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

    public function getInputs(Request $request, $cropType)
    {
        $selectedSections = $request->input('sections', []);
        $inputsDTO = Calculator::getInputs($selectedSections, $cropType);
        
        $sectionLabels = $inputsDTO['sectionLabels'];
        $inputs = $inputsDTO['inputs'];


        return view('inputPage', compact('inputs', 'selectedSections', 'cropType', 'sectionLabels'));
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
