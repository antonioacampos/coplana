@extends('layouts.app')

@section('content')
  <div class="d-flex justify-content-center align-items-center">
    <div class="card mt-3 mb-3">
      <div class="card-body p-0">
        <div class="card-header">
          <a href="./">
            <h6>< Página inicial</h6>
          </a>

          <h1>Calculadora do {{ $cropType }}</h1>
          <h3>Selecione as seções para calcular</h3>
        </div>

        <form id="sectionForm" method="POST" action="{{ route('get.inputs', ['cropType' => $cropType]) }}">
          @csrf
          <div class="form-group p-3">
            @foreach ($sectionLabels as $sectionKey => $sectionLabel)
              <input type="checkbox" id="{{ $sectionKey }}" name="sections[]" value="{{ $sectionKey }}">
              <label for="{{ $sectionKey }}">{{ $sectionLabel }}</label><br>
            @endforeach
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
                  <label for="{{ $input['name'] }}">Digite o custo unitário de {{ $input['label'] }}:</label>
                  <input type="number" step="any" class="form-control" id="{{ $input['name'] }}" name="inputs[{{ $input['name'] }}]"
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

<style>
  body {
    background-image: url('{{ asset('background3.webp') }}');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    overflow-x: hidden;
  }


 
  .card-header h1, .card-header h2, .card-header a, .card-body {
    color: white;
  }

  .card {
    background-color: rgba(10, 55, 23, 0.7) !important;
  } 

  .btn-primary, .btn-success {
    border-radius: 5px;
    padding: 10px 20px;
    font-weight: bold;
  }body {
    background-image: url('{{ asset('background3.webp') }}');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    overflow-x: hidden;
  }

  .card-header h1,
  .card-header h5,
  .card-body,
  .card-title {
    color: white;
  }

  .card {
    background-color: rgba(10, 55, 23, 0.7) !important;
  }

  .btn-primary,
  .btn-success {
    border-radius: 5px;
    padding: 10px 20px;
    font-weight: bold;
  }

  @media (max-width: 576px) {
    .card-header h1 {
      font-size: 1.5rem;
    }

    .card-header h5 {
      font-size: 1rem;
    }

    .card-body h2 {
      font-size: 1.25rem;
    }

    .card-body h3 {
      font-size: 1rem;
    }
  }

  @media (max-width: 768px) {
    .card-header h1 {
      font-size: 2rem;
    }

    .card-header h5 {
      font-size: 1.25rem;
    }

    .card-body h2 {
      font-size: 1.5rem;
    }

    .card-body h3 {
      font-size: 1.25rem;
    }
  }
</style>
