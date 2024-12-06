<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Resultados</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }

    table, th, td {
      border: 1px solid black;
    }

    th, td {
      padding: 8px;
      text-align: left;
    }
  </style>
</head>

<body>
  <h1>Resultados da Calculadora</h1>
  @if (!empty($selectedSections))
    @foreach ($selectedSections as $section)
      <h2>{{ $sectionLabels[$section] ?? ucfirst($section) }}:</h2>
      @if (isset($finalResults[$section]))
        @foreach ($finalResults[$section] as $subsection => $values)
          <h4>{{ $sectionLabels[$section . '.' . $subsection] ?? ucfirst(str_replace('_', ' ', $subsection)) }}:</h4>
          <table>
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
    @endforeach
  @else
    <p>Nenhuma seção foi selecionada.</p>
  @endif
</body>

</html>
