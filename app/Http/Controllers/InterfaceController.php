<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Calculator;
use App\Services\JsonFileManager;
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

    public function jsonIndex()
    {
        return view('json.index');
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

        try {
            $content = json_decode($request->content, true);

            if (JsonFileManager::exists($request->folder, $request->filename)) {
                return redirect()->route('json.create')
                    ->with('error', 'Arquivo já existe.');
            }

            JsonFileManager::store($request->folder, $request->filename, $content);

            return redirect()->route('json.index')
                ->with('success', 'Arquivo criado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('json.create')
                ->with('error', 'Erro ao criar arquivo: ' . $e->getMessage());
        }
    }

    public function edit($folder, $filename)
    {
        try {
            $content = JsonFileManager::get($folder, $filename);
            
            if ($content === null) {
                return redirect()->route('json.index')
                    ->with('error', 'Arquivo não encontrado.');
            }

            return view('json.edit', compact('folder', 'filename', 'content'));
        } catch (\Exception $e) {
            return redirect()->route('json.index')
                ->with('error', 'Erro ao editar arquivo: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $folder, $filename)
    {
        $request->validate([
            'content' => 'required|json',
        ]);

        try {
            $content = json_decode($request->content, true);

            if (!JsonFileManager::exists($folder, $filename)) {
                return redirect()->route('json.index')
                    ->with('error', 'Arquivo não encontrado.');
            }

            JsonFileManager::store($folder, $filename, $content);

            return redirect()->route('json.index')
                ->with('success', 'Arquivo atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('json.edit', [$folder, $filename])
                ->with('error', 'Erro ao atualizar arquivo: ' . $e->getMessage());
        }
    }

    public function destroy($folder, $filename)
    {
        try {
            if (!JsonFileManager::exists($folder, $filename)) {
                return redirect()->route('json.index')
                    ->with('error', 'Arquivo não encontrado.');
            }

            JsonFileManager::delete($folder, $filename);

            return redirect()->route('json.index')
                ->with('success', 'Arquivo deletado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('json.index')
                ->with('error', 'Erro ao deletar arquivo: ' . $e->getMessage());
        }
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
