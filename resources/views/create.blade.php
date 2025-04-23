@extends('layouts.app')

@section('content')
  <div class="d-flex justify-content-center align-items-center">
    <div class="card mt-3 mb-3">
      <div class="card-body p-0">
        <div class="card-header">
          <a href="{{ route('home') }}">
            <h6>&lt; Página inicial</h6>
          </a>
          <h1>Criar Novo JSON</h1>
        </div>

        <form action="{{ route('json.store') }}" method="POST">
          @csrf
          <div class="form-group p-3">
            <label for="folder" class="font-weight-bold">Pasta:</label>
            <select name="folder" class="form-control form-select border-primary shadow-lg p-2 rounded" id="folder">
              <option value="equipamentos">Equipamentos</option>
              <option value="inputs">Inputs</option>
              <option value="multiplicadores">Multiplicadores</option>
            </select>
          </div>

          <div class="form-group p-3">
            <label for="filename" class="font-weight-bold">Nome do arquivo:</label>
            <input type="text" name="filename" class="form-control border-secondary shadow-sm" id="filename" required>
          </div>

          <div class="form-group p-3">
            <label for="content" class="font-weight-bold">Conteúdo JSON:</label>
            <textarea name="content" class="form-control border-secondary shadow-sm" id="content" rows="8" style="width: 100%;"></textarea>
          </div>

          <button type="submit" class="btn btn-success m-2">Criar</button>
        </form>
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
  .card-header h6,
  .card-body {
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

  select.form-select {
    background-color: #D3D3D3;
    border-width: 2px;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
  }

  select.form-select:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
  }

  .form-control {
    width: 100%;
  }

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
  .card-header h6,
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

    .card-header h6 {
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

    .card-header h6 {
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
