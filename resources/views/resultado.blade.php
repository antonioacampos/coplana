@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Resultados da Calculadora</h1>

    @if(!empty($selectedSections))
        <h2>Seções Selecionadas:</h2>
        <ul>
            @foreach($selectedSections as $section)
                <li>{{ ucfirst($section) }}</li>
            @endforeach
        </ul>

        <h2>Resultados dos Inputs:</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Input</th>
                    <th>Valor Original</th>
                    <th>Valor Final (Multiplicado por 2.2)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($finalResults as $inputName => $inputValue)
                    <tr>
                        <td>{{ ucfirst(str_replace('_', ' ', $inputName)) }}</td>
                        <td>{{ is_numeric($inputValue) ? $inputValue / 2.2 : 'Valor inválido' }}</td>
                        <td>{{ $inputValue }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Nenhuma seção foi selecionada.</p>
    @endif

</div>
@endsection
