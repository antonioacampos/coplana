@extends('layouts.app')

@section('content')
  <div class="container mt-3">
    <a href="./">
      <h6>Página inicial</h6>
    </a>
    <h1>Resultados da Calculadora</h1>
    <div class="card mb-2 mt-2 p-2">
      <h6 class="m-1">Valor total da produção: R$ {{ number_format($totalSum, 2, ',', '.') }}</h6>
    </div>
    <a href="{{ route('export.csv', ['sections' => $selectedSections, 'results' => $finalResults,   'cropType' => $cropType]) }}"
      class="btn m-1 btn-primary">Exportar CSV</a>
    <a href="{{ route('export.pdf', ['sections' => $selectedSections, 'results' => $finalResults]) }}"
      class="btn btn-danger">Exportar PDF</a>

    @if (!empty($selectedSections))
      @foreach ($selectedSections as $section)
        <h2>{{ ucfirst($section) }}:</h2>
        @if (isset($finalResults[$section]))
          @foreach ($finalResults[$section] as $subsection => $values)
            <h4>{{ ucfirst(str_replace('_', ' ', $subsection)) }}:</h4>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Campo</th>
                  <th>Valor Final</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($values as $inputName => $inputValue)
                  <tr>
                    <td>{{ ucfirst(str_replace('_', ' ', $inputName)) }}</td>
                    <td>
                      @if (is_numeric($inputValue))
                        R$ {{ number_format($inputValue, 2, ',', '.') }}
                      @else
                        {{ $inputValue }}
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          @endforeach
        @else
          <p>Nenhuma subseção encontrada para esta seção.</p>
        @endif
      @endforeach
    @else
      <p>Nenhuma seção foi selecionada.</p>
    @endif
  </div>
@endsection
