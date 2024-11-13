@extends('layouts.app')
@section('content')
  <div class="card m-3 border-2 border-success">
    <div class="card-header">
      <h1>Coplana</h1>
      <h5 class="card-title">Sistema estruturado de custos</h5>
    </div>
    <div class="card-body">
      <h2>Calculadoras:</h2>
      @foreach ($cropTypes as $cropType)
      <a href="{{ route('calculadora', ['cropType' => $cropType]) }}">
        <h3 class="text-success">Cultura de {{ $cropType }}</h3>
      </a>
      @endforeach
    </div>
  </div>
@endsection


<style>
  body {
    background-image: url('{{ asset('background3.png') }}'); 
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    font-family: Arial, sans-serif;
  }

 
  .card-header h1, .card-header h2, .card-header a, .card-body, .card-title {
    color: white;
  }

  .card {
    background-color: rgba(10, 55, 23, 0.7) !important;
  } 

  .btn-primary, .btn-success {
    border-radius: 5px;
    padding: 10px 20px;
    font-weight: bold;
  }
</style>