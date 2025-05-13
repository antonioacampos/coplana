@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-3 mb-3">
        <div class="card-header">
            <a href="{{ route('home') }}" class="text-white text-decoration-none">
                <h6>&lt; Página inicial</h6>
            </a>
            <div class="d-flex justify-content-between align-items-center">
                <h1>Arquivos JSON</h1>
                <a href="{{ route('json.create') }}" class="btn btn-success">Novo Arquivo</a>
            </div>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row">
                <!-- Inputs -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Inputs</h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group">
                                @foreach(\App\Services\JsonFileManager::listFiles('inputs') as $file)
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>{{ $file }}</span>
                                        <div class="btn-group">
                                            <a href="{{ route('json.edit', ['folder' => 'inputs', 'filename' => $file]) }}" 
                                               class="btn btn-sm btn-primary">Editar</a>
                                            <button type="button" class="btn btn-sm btn-danger" 
                                                    onclick="confirmDelete('inputs', '{{ $file }}')">Excluir</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Multiplicadores -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">Multiplicadores</h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group">
                                @foreach(\App\Services\JsonFileManager::listFiles('multiplicadores') as $file)
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>{{ $file }}</span>
                                        <div class="btn-group">
                                            <a href="{{ route('json.edit', ['folder' => 'multiplicadores', 'filename' => $file]) }}" 
                                               class="btn btn-sm btn-primary">Editar</a>
                                            <button type="button" class="btn btn-sm btn-danger" 
                                                    onclick="confirmDelete('multiplicadores', '{{ $file }}')">Excluir</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Equipamentos -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">Equipamentos</h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group">
                                @foreach(\App\Services\JsonFileManager::listFiles('equipamentos') as $file)
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>{{ $file }}</span>
                                        <div class="btn-group">
                                            <a href="{{ route('json.edit', ['folder' => 'equipamentos', 'filename' => $file]) }}" 
                                               class="btn btn-sm btn-primary">Editar</a>
                                            <button type="button" class="btn btn-sm btn-danger" 
                                                    onclick="confirmDelete('equipamentos', '{{ $file }}')">Excluir</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmar Exclusão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja excluir este arquivo?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function confirmDelete(folder, filename) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        form.action = `/json/${folder}/${filename}`;
        
        // Show modal
        modal.style.display = 'block';
        modal.classList.add('show');
        
        // Close modal when clicking the close button or cancel button
        const closeButtons = modal.querySelectorAll('[data-dismiss="modal"]');
        closeButtons.forEach(button => {
            button.addEventListener('click', () => {
                modal.style.display = 'none';
                modal.classList.remove('show');
            });
        });
        
        // Close modal when clicking outside
        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.style.display = 'none';
                modal.classList.remove('show');
            }
        });
    }
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

    .list-group-item {
        background-color: rgba(255, 255, 255, 0.9);
        color: #333;
        border: 1px solid rgba(0, 0, 0, 0.125);
    }

    .list-group-item:hover {
        background-color: rgba(255, 255, 255, 0.95);
    }

    .btn {
        padding: 5px 10px;
        font-weight: bold;
        border-radius: 5px;
    }

    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
    }

    .modal.show {
        display: block;
    }

    .modal-content {
        background-color: rgba(10, 55, 23, 0.9);
        color: white;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 500px;
        border-radius: 5px;
    }

    .modal-header {
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        padding-bottom: 10px;
        margin-bottom: 10px;
    }

    .modal-footer {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding-top: 10px;
        margin-top: 10px;
    }

    .close {
        color: white;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover {
        color: #28a745;
    }
</style> 