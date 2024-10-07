@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <a href="./"><h6>Página inicial</h6></a>
    <h1>Resultados da Calculadora</h1>

    @if(!empty($selectedSections))
        @foreach($selectedSections as $section)
            <h2>{{ ucfirst($section) }}:</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Campo</th>
                        <th>Valor Final</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($finalResults[$section] as $inputName => $inputValue)
                        <tr>
                            <td>{{ ucfirst(str_replace('_', ' ', $inputName)) }}</td>
                            <td>R$ {{ $inputValue }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    @else
        <p>Nenhuma seção foi selecionada.</p>
    @endif
</div>
@endsection
