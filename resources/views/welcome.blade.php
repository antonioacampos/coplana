@extends('layouts.app')
@section('content')
  <div class="container-fluid p-3">
    <div class="card border-2 border-success">
      <div class="card-header">
        <h1>Coplana</h1>
        <h5 class="card-title">Sistema estruturado de custos</h5>
      </div>
      <div class="card-body">
        <h2 class="mb-4">Calculadoras:</h2>
        <div class="">
          @foreach ($cropTypes as $cropType)
            <div class="mb-3">
              <a href="{{ route('calculadora', ['cropType' => $cropType]) }}" class="text-decoration-none">
                <h3 class="text-success">Cultura de {{ str_replace('_', ' ', ucwords($cropType)) }}</h3>
                </a>
            </div>
          @endforeach
        </div>
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
