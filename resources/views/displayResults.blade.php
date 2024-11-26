@extends('layouts.app')

@section('content')
  <div class="container p-2 pt-3 mt-3 mb-3">
    <a href="./">
      <h6>
        < Página inicial</h6>
    </a>
    <h1>Resultados da Calculadora</h1>
    <div class="card mb-2 mt-2 p-2">
      <h6 class="m-1">Valor total da produção: R$ {{ number_format($totalSum, 2, ',', '.') }}</h6>
    </div>
    <a href="{{ route('export.csv', ['sections' => $selectedSections, 'results' => $finalResults, 'cropType' => $cropType]) }}"
      class="btn m-1 btn-primary">Exportar CSV</a>
    <a href="{{ route('export.pdf', ['sections' => $selectedSections, 'results' => $finalResults, 'cropType' => $cropType]) }}"
      class="btn btn-danger">Exportar PDF</a>

    @if (!empty($selectedSections))
      @foreach ($selectedSections as $section)
        <h2>{{ $sectionLabels[$section] ?? ucfirst($section) }}:</h2>
        <h5>Custo da seção: R$ {{ number_format($sectionTotals[$section] ?? 0, 2, ',', '.') }}</h5>
        <br>
        @if (isset($finalResults[$section]))
          @foreach ($finalResults[$section] as $subsection => $values)
            <h4>{{ $sectionLabels[$section . '.' . $subsection] ?? ucfirst(str_replace('_', ' ', $subsection)) }}</h4>
            <h6>Custo da subseção: R$ {{ number_format($subsectionTotals[$section][$subsection] ?? 0, 2, ',', '.') }}</h6>
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
                    <td>{{ $sectionLabels[$inputName] ?? ucfirst(str_replace('_', ' ', $inputName)) }}</td>
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
        <hr style = "background-color: white; padding: 2px">
      @endforeach
    @else
      <p>Nenhuma seção foi selecionada.</p>
    @endif
  </div>
@endsection

<style>
  body {
    background-image: url('{{ asset('background3.webp') }}');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    font-family: Arial, sans-serif;
    overflow-x: hidden;
  }

  .card-header h1,
  .card-header h2,
  .card-header a,
  .card-body,
  .container,
  th,
  td {
    color: white;
  }

  .card,
  .container {
    background-color: rgba(10, 55, 23, 0.7) !important;
  }

  .btn-primary,
  .btn-success {
    border-radius: 5px;
    padding: 10px 20px;
    font-weight: bold;
  }
</style>
