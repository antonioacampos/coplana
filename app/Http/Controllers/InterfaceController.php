<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Calculator;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

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

    

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'folder' => 'required|in:equipamentos,inputs,multiplicadores',
            'filename' => 'required|string',
            'content' => 'required|json',
        ]);

        $filePath = "{$request->folder}/{$request->filename}.json";

        if (Storage::exists($filePath)) {
            return redirect()->route('json.create')->with('error', 'Arquivo já existe.');
        }

        Storage::put($filePath, $request->content);

        return redirect()->route('json.create')->with('success', 'Arquivo criado com sucesso!');
    }

    public function edit($folder, $filename)
    {
        $filePath = "app/{$folder}/{$filename}.json";

        if (!Storage::exists($filePath)) {
            return redirect()->route('json.index')->with('error', 'Arquivo não encontrado.');
        }

        $content = Storage::get($filePath);
        return view('json.edit', compact('folder', 'filename', 'content'));
    }

    public function update(Request $request, $folder, $filename)
    {
        $request->validate([
            'content' => 'required|json',
        ]);

        $filePath = "app/{$folder}/{$filename}.json";

        if (!Storage::exists($filePath)) {
            return redirect()->route('json.index')->with('error', 'Arquivo não encontrado.');
        }

        Storage::put($filePath, $request->content);

        return redirect()->route('json.index')->with('success', 'Arquivo atualizado com sucesso!');
    }

    public function destroy($folder, $filename)
    {
        $filePath = "app/{$folder}/{$filename}.json";

        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
            return redirect()->route('json.index')->with('success', 'Arquivo deletado com sucesso!');
        }

        return redirect()->route('json.index')->with('error', 'Arquivo não encontrado.');
    }



    public function getInputs(Request $request, $cropType)
    {
        $selectedSections = $request->input('sections', []);
        $inputsDTO = Calculator::getInputs($selectedSections, $cropType);

        $sectionLabels = $inputsDTO['sectionLabels'];
        $inputs = $inputsDTO['inputs'];
    
        $allEquipmentModels = Calculator::loadEquipmentModels($cropType);
        
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
