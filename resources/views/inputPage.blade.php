@extends('layouts.app')

@section('content')
  <div class="d-flex justify-content-center align-items-center">
    <div class="card mt-3">
      <div class="card-body p-0">
        <div class="card-header">
          <a href="./">
            <h6>Página inicial</h6>
          </a>

          <h1>Calculadora do {{ $cropType }}</h1>
          <h2>Selecione as seções para calcular</h2>
        </div>

        <form id="sectionForm" method="POST" action="{{ route('get.inputs', ['cropType' => $cropType]) }}">
          @csrf
          <div class="form-group p-3">
            <input type="checkbox" id="preparo" name="sections[]" value="preparo">
            <label for="preparo">Preparo do solo</label><br>
            <input type="checkbox" id="aplicacao" name="sections[]" value="aplicacao">
            <label for="aplicacao">Aplicação de corretivos</label><br>
            <input type="checkbox" id="plantio" name="sections[]" value="plantio">
            <label for="plantio">Plantio</label><br>
            <input type="checkbox" id="manejo" name="sections[]" value="manejo">
            <label for="manejo">Manejo</label><br>
            <input type="checkbox" id="colheita" name="sections[]" value="colheita">
            <label for="colheita">Colheita</label><br>
          </div>

          <button type="submit" class="btn btn-primary m-2">Carregar Inputs</button>
        </form>

        @if (!empty($inputs))
          <form method="POST" action="{{ route('calcular') }}">
            @csrf

            <input type="hidden" name="cropType" value="{{ $cropType }}">

            @foreach ($selectedSections as $section)
              <input type="hidden" name="sections[]" value="{{ $section }}">
            @endforeach

            <div id="inputFields" class="m-2">
              @foreach ($inputs as $input)
                <div class="form-group">
                  <label for="{{ $input['name'] }}">Digite o custo unitário de {{ $input['label'] }}</label>
                  <input type="number" class="form-control" id="{{ $input['name'] }}" name="inputs[{{ $input['name'] }}]"
                    placeholder="Custo unitário de {{ $input['label'] }}" required>
                </div>
              @endforeach
            </div>

            <button type="submit" class="btn btn-success m-2">Enviar Dados</button>
          </form>
        @endif
      </div>
    </div>
  </div>
@endsection
