@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h1>Resultados da Calculadora</h1>

    @if(!empty($selectedSections))
        <h2>Seções Selecionadas:</h2>
        <ul>
            @foreach($selectedSections as $section)
                <h6>{{ ucfirst($section) }}</h6>
            @endforeach
        </ul>

        <h2>Resultados dos Inputs:</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Campo</th>
                    <th>Valor Final</th>
                </tr>
            </thead>
            <tbody>
                @foreach($finalResults as $inputName => $inputValue)
                    <tr>
                        <td>{{ ucfirst(str_replace('_', ' ', $inputName)) }}</td>
                        <td>R$ {{ $inputValue }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Nenhuma seção foi selecionada.</p>
    @endif

</div>
@endsection
