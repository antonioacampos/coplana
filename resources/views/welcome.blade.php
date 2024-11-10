@extends('layouts.app')
@section('content')
  <div class="card m-3 border-2 border-danger">
    <div class="card-header">
      <h1>Coplana</h1>
      <h5 class="card-title">Sistema estruturado de custos</h5>
    </div>
    <div class="card-body">
      <h2>Calculadoras:</h2>
      @foreach ($cropTypes as $cropType)
      <a href="{{ route('calculadora', ['cropType' => $cropType]) }}">
        <h3>Cultura de {{ $cropType }}</h3>
      </a>
      @endforeach
    </div>
  </div>
@endsection
