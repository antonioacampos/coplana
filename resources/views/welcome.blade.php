@extends('layouts.app')
@section('content')
  <div class="card m-3 border-2 border-danger">
    <div class="card-header">
      <h1>Coplana</h1>
      <h5 class="card-title">Sistema estruturado de custos</h5>
    </div>
    <div class="card-body">
      <h2>Calculadoras:</h2>
      <a href="./calculadora-soja">
        <h3>Cultura de soja</h3>
      </a>
      <a href="./calculadora-amendoim">
        <h3>Cultura de amendoim</h3>
      </a>
      <a href="./calculadora-cana-planta">
        <h3>Cultura de cana-de-açúcar (planta)</h3>
      </a>
      <a href="./calculadora-cana-soca">
        <h3>Cultura de cana-de-açúcar (soca)</h3>
      </a>
    </div>
  </div>
@endsection
