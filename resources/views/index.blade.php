@extends('layouts.app')

@section('content')
  <div class="d-flex justify-content-center align-items-center">
    <div class="card mt-3 mb-3">
      <div class="card-body p-0">
        <div class="card-header">
          <a href="{{ route('home') }}">
            <h6>&lt; Página inicial</h6>
          </a>
          <h1>Arquivos JSON</h1>
        </div>

        <a href="{{ route('json.create') }}" class="btn btn-primary m-2">Criar Novo</a>

        @foreach ($files as $folder => $jsonFiles)
          <div class="folder-section">
            <h2 class="text-white">{{ ucfirst($folder) }}</h2>
            <ul class="list-group">
              @foreach ($jsonFiles as $file)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <a href="{{ route('json.show', [$folder, pathinfo($file, PATHINFO_FILENAME)]) }}" class="text-white">{{ $file }}</a>
                  <div class="actions">
                    <a href="{{ route('json.edit', [$folder, pathinfo($file, PATHINFO_FILENAME)]) }}" class="btn btn-warning btn-sm">✏️</a>
                    <form action="{{ route('json.destroy', [$folder, pathinfo($file, PATHINFO_FILENAME)]) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                    </form>
                  </div>
                </li>
              @endforeach
            </ul>
          </div>
        @endforeach
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
  .btn-warning,
  .btn-danger {
    border-radius: 5px;
    padding: 8px 15px;
    font-weight: bold;
  }

  .folder-section {
    margin-top: 2rem;
    margin-bottom: 2rem;
  }

  .folder-section h2 {
    color: white;
  }

  .list-group-item {
    background-color: rgba(255, 255, 255, 0.2) !important;
    border: none;
    color: white;
  }

  .list-group-item a {
    color: white;
    text-decoration: none;
  }

  .list-group-item a:hover {
    text-decoration: underline;
  }

  .actions {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .btn-warning,
  .btn-danger {
    font-size: 1.2rem;
  }

  .btn-sm {
    padding: 5px 10px;
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
  .card-body {
    color: white;
  }

  .card {
    background-color: rgba(10, 55, 23, 0.7) !important;
  }

  .btn-primary,
  .btn-warning,
  .btn-danger {
    border-radius: 5px;
    padding: 8px 15px;
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
