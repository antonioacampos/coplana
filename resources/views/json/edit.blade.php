@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-3 mb-3">
        <div class="card-header">
            <a href="{{ route('json.index') }}" class="text-white text-decoration-none">
                <h6>&lt; Voltar para lista</h6>
            </a>
            <h1>Editar JSON</h1>
        </div>

        <div class="card-body">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('json.update', ['folder' => $folder, 'filename' => $filename]) }}" method="POST" id="jsonForm">
                @csrf
                @method('PUT')

                <div class="form-group mb-4">
                    <label class="form-label">Tipo de Arquivo:</label>
                    <input type="text" class="form-control" value="{{ ucfirst($folder) }}" readonly>
                </div>

                <div class="form-group mb-4">
                    <label class="form-label">Nome do Arquivo:</label>
                    <input type="text" class="form-control" value="{{ $filename }}" readonly>
                </div>

                <div class="form-group mb-4">
                    <label for="content" class="form-label">Conteúdo JSON:</label>
                    <textarea name="content" class="form-control" id="json" rows="8" style="width: 100%;">{{ json_encode($content, JSON_PRETTY_PRINT) }}</textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <a href="{{ route('json.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function isValidJSON(str) {
      try {
        JSON.parse(str);
        return true;
      } catch (e) {
        return false;
      }
    }

    document.getElementById('jsonForm').addEventListener('submit', function(e) {
      const content = document.getElementById('json').value;
      console.log(content)
      if (!isValidJSON(content)) {
        e.preventDefault();
        alert('O conteúdo não é um JSON válido. Por favor, corrija e tente novamente.');
      }
    });
  </script>
@endpush

<style>
    body {
        background-image: url('{{ asset('background3.webp') }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        font-family: Arial, sans-serif;
    }

    .card {
        background-color: rgba(10, 55, 23, 0.7) !important;
        border: none;
        border-radius: 15px;
    }

    .card-header {
        background-color: rgba(10, 55, 23, 0.9) !important;
        border-bottom: none;
        border-radius: 15px 15px 0 0 !important;
    }

    .card-header h1,
    .card-header h6 {
        color: white;
        margin: 0;
    }

    .card-body {
        color: white;
    }

    .form-label {
        color: white;
        font-weight: bold;
    }

    .form-control,
    .form-select {
        background-color: rgba(255, 255, 255, 0.9);
    }

    .structure-builder {
        background-color: rgba(10, 55, 23, 0.5);
        border-radius: 5px;
        padding: 20px;
    }

    .section-item,
    .subsection-item {
        background-color: rgba(255, 255, 255, 0.9);
        border: 1px solid #dee2e6;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 10px;
        color: #333;
    }

    .section-item:hover,
    .subsection-item:hover {
        background-color: rgba(255, 255, 255, 0.95);
    }

    .btn {
        padding: 10px 20px;
        font-weight: bold;
        border-radius: 5px;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .btn-outline-light {
        border-color: white;
        color: white;
    }

    .btn-outline-light:hover {
        background-color: white;
        color: #0a3717;
    }
</style> 